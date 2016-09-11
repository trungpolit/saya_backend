<?php

App::uses('CacheCommon', 'Lib');

class OrdersDistributor extends AppModel {

    public $useTable = 'orders_distributors';
    public $belongsTo = array(
        'Order' => array(
            'className' => 'Order',
        ),
    );
    public $cached = 1;
    public $hasMany = array(
        'OrdersProduct' => array(
            'className' => 'OrdersProduct',
        ),
    );
    public $actsAs = array('ManagerFilter');
    public $data_old = array();

    public function beforeSave($options = array()) {
        parent::beforeSave($options);

        // khi thực hiện edit thay đổi trạng thái status của đơn hàng
        if (
                !empty($this->data[$this->alias]['id'])
        ) {

            // thực hiện lưu lại status dữ liệu của bản ghi trước khi bị thay đổi
            $data_old = $this->findById($this->data[$this->alias]['id']);
            $this->data_old = $data_old;
        }
    }

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);

        if (
                !empty($this->data[$this->alias]['customer_code']) &&
                !empty($this->data[$this->alias]['no']) &&
                $this->cached
        ) {

            $this->Behaviors->disable('ManagerFilter');
            $page = ceil($this->data[$this->alias]['no'] / ORDER_LIMIT);
            $this->cacheByCustomerPage($this->data[$this->alias]['customer_code'], $page);
        }

        // khi thực hiện edit thay đổi trạng thái status của đơn hàng
        // và trạng thái status bị thay đổi khác với trạng thái status trước đó
        if (
                !$created &&
                !empty($this->data[$this->alias]['customer_id']) &&
                isset($this->data[$this->alias]['status']) &&
                $this->data[$this->alias]['status'] != $this->data_old[$this->alias]['status']
        ) {

            // thực hiện cập nhật lại cache tổng số đơn hàng trong Customer
            App::uses('Customer', 'Model');
            $Customer = new Customer();

            $customer = $Customer->findById($this->data[$this->alias]['customer_id']);
            if (empty($customer)) {
                throw new NotImplementedException(__('The customer with id=%s does not exist', $this->data[$this->alias]['customer_id']));
            }

            $status_alias = $this->getStatusAlias($this->data[$this->alias]['status']);
            $status_old_alias = $this->getStatusAlias($this->data_old[$this->alias]['status']);

            $status_field = 'total_order_distributor_' . $status_alias;
            $status_old_field = 'total_order_distributor_' . $status_old_alias;

            $$status_old_field = !empty($customer[$Customer->alias][$status_old_field]) ?
                    $customer[$Customer->alias][$status_old_field] : 0;
            $$status_old_field -= 1;

            $$status_field = !empty($customer[$Customer->alias][$status_field]) ?
                    $customer[$Customer->alias][$status_field] : 0;
            $$status_field += 1;

            // thực hiện update thông tin thống kê vào Customer
            $save_data = array(
                'id' => $customer[$Customer->alias]['id'],
                $status_old_field => $$status_old_field,
                $status_field => $$status_field
            );

            // thực hiện set trạng thái của Customer thành STATUS_BUY_BAD nếu đơn hàng bị đánh trạng thái là giả mạo
            if ($this->data[$this->alias]['status'] == STATUS_BAD) {
                $save_data['status'] = STATUS_BUY_BAD;
            }
            $Customer->save($save_data);
        }
        if (
                !$created &&
                !empty($this->data[$this->alias]['region_id']) &&
                !empty($this->data[$this->alias]['distributor_id']) &&
                !empty($this->data[$this->alias]['created']) &&
                isset($this->data[$this->alias]['total_price']) &&
                isset($this->data[$this->alias]['status']) &&
                $this->data[$this->alias]['status'] != $this->data_old[$this->alias]['status']
        ) {

            App::uses('DailyReport', 'Model');
            $DailyReport = new DailyReport();
            $region_id = $this->data[$this->alias]['region_id'];
            $distributor_id = $this->data[$this->alias]['distributor_id'];
            $date = date('Ymd', strtotime($this->data[$this->alias]['created']));

            $DailyReport->Behaviors->disable('ManagerFilter');
            $report_daily = $DailyReport->checkExist($date, $region_id, $distributor_id);
            if (empty($report_daily)) {
                throw new NotImplementedException(__('The DailyReport with date=%s, region_id=%s, distributor_id=%s  does not exist', $date, $region_id, $distributor_id));
            }

            $status_alias = $this->getStatusAlias($this->data[$this->alias]['status']);
            $status_old_alias = $this->getStatusAlias($this->data_old[$this->alias]['status']);

            $status_field = 'total_order_distributor_' . $status_alias;
            $status_old_field = 'total_order_distributor_' . $status_old_alias;

            $$status_old_field = !empty($report_daily[$DailyReport->alias][$status_old_field]) ?
                    $report_daily[$DailyReport->alias][$status_old_field] : 0;
            $$status_old_field -= 1;

            $$status_field = !empty($report_daily[$DailyReport->alias][$status_field]) ?
                    $report_daily[$DailyReport->alias][$status_field] : 0;
            $$status_field += 1;

            // thực hiện update doanh thu
            $total_revernue = !empty($report_daily[$DailyReport->alias]['total_revernue']) ?
                    $report_daily[$DailyReport->alias]['total_revernue'] : 0;
            // nếu trạng thái mới là STATUS_SUCCESS
            if ($this->data[$this->alias]['status'] == STATUS_SUCCESS) {
                $total_revernue += $this->data[$this->alias]['total_price'];
            }
            // nếu trạng thái cũ là STATUS_SUCCESS
            elseif ($this->data_old[$this->alias]['status'] == STATUS_SUCCESS) {
                $total_revernue -= $this->data[$this->alias]['total_price'];
            }

            // thực hiện update thông tin thống kê vào DailyReport
            $save_data = array(
                'id' => $report_daily[$DailyReport->alias]['id'],
                $status_old_field => $$status_old_field,
                $status_field => $$status_field,
                'total_revernue' => $total_revernue,
            );
            $DailyReport->save($save_data);
        }


        // nếu thưc hiện tạo mới customer thì cộng +1 vào report_dailys.total_order_distributor
        // công +1 vào report_dailys.total_order_distributor_pending
        if (
                $created &&
                isset($this->data[$this->alias]['region_id']) &&
                isset($this->data[$this->alias]['distributor_id'])
        ) {

            App::uses('DailyReport', 'Model');
            $DailyReport = new DailyReport();
            $region_id = $this->data[$this->alias]['region_id'];
            $distributor_id = $this->data[$this->alias]['distributor_id'];
            $date = date('Ymd', strtotime($this->data[$this->alias]['created']));
            $save_data = array();

            $report_daily = $DailyReport->checkExist($date, $region_id, $distributor_id);
            if (empty($report_daily)) {
                $DailyReport->create();
                $save_data['date'] = $date;
                $save_data['region_id'] = $region_id;
                $save_data['distributor_id'] = $distributor_id;
                $save_data['total_order_distributor'] = 1;
                $save_data['total_order_distributor_pending'] = 1;
                $DailyReport->save($save_data);
            } else {
                $DailyReport->incrementField($report_daily[$DailyReport->alias]['id'], array(
                    'total_order_distributor',
                    'total_order_distributor_pending',
                ));
            }
        }

        // Thực hiện đồng bộ hóa status với OrdersProduct
        $this->updateOrdersProduct($created);
    }

    protected function updateOrdersProduct($created) {
        // Thực hiện đồng bộ hóa status với OrdersProduct
        if (!$created && isset($this->data[$this->alias]['status'])) {
            $orders_product = $this->OrdersProduct->findAllByOrdersDistributorId($this->id);
            if (empty($orders_product)) {
                return true;
            }
            $save_data = array();
            foreach ($orders_product as $k => $v) {
                $save_data[$k] = array(
                    'id' => $v[$this->OrdersProduct->alias]['id'],
                    'status' => $this->data[$this->alias]['status'],
                );
            }
            return $this->OrdersProduct->saveAll($save_data);
        }
    }

    protected function getStatusAlias($status) {
        switch ($status) {
            case STATUS_PENDING:
                return 'pending';
            case STATUS_PROCESSING:
                return 'processing';
            case STATUS_SUCCESS:
                return 'success';
            case STATUS_FAIL:
                return 'fail';
            case STATUS_BAD:
                return 'bad';
            default :
                return 'pending';
        }
    }

    public function cache() {
        App::uses('Customer', 'Model');
        $Customer = new Customer();

        // lấy ra toàn bộ danh sách Customer
        $customers = $Customer->find('all');
        if (empty($customers)) {
            return;
        }

        foreach ($customers as $v) {
            $customer_code = $v[$Customer->alias]['code'];
            // lấy ra toàn bộ đơn hàng tương ứng
            $orders = $this->find('all', array(
                'conditions' => array(
                    'customer_code' => $customer_code,
                ),
                'order' => array(
                    'no' => 'DESC',
                ),
                'recursive' => -1,
            ));
            if (empty($orders)) {
                continue;
            }

            // thực hiện gộp các order theo từng page để cache
            $order_data = array();
            foreach ($orders as $vv) {
                $no = $vv[$this->alias]['no'];
                $page = ceil($no / ORDER_LIMIT);
                $order_data[$page][] = $vv;
            }

            foreach ($order_data as $kk => $vv) {
                $this->cacheByCustomerPage($customer_code, $kk, array(
                    'order_data' => $vv,
                ));
            }
        }
    }

    public function cacheByCustomerPage($customer_code, $page, $options = array()) {
        if (isset($options['order_data'])) {
            $order_data = $options['order_data'];
        } else {
            $no_begin = ($page - 1) * ORDER_LIMIT + 1;
            $no_end = $page * ORDER_LIMIT;

            $order_data = $this->find('all', array(
                'recursive' => -1,
                'order' => array(
                    'no' => 'DESC',
                ),
                'conditions' => array(
                    'customer_code' => $customer_code,
                    'no >=' => $no_begin,
                    'no <=' => $no_end,
                ),
            ));
        }

        if (empty($order_data)) {
            return;
        }

        $cache_path = APP . Configure::read('saya.App.cache_path') . $this->useTable . '/' . $customer_code . '/' . $page . '.json';
        // thực hiện parse lại format trước khi cache
        $pretty_data = array();
        foreach ($order_data as $k => $v) {
            $region_id = $v[$this->alias]['region_id'];
            $pretty_data[$k] = array(
                'customer_code' => $v[$this->alias]['customer_code'],
                'customer_id' => $v[$this->alias]['customer_id'],
                'customer_name' => $v[$this->alias]['customer_name'],
                'customer_mobile' => $v[$this->alias]['customer_mobile'],
                'customer_mobile2' => $v[$this->alias]['customer_mobile2'],
                'customer_address' => $v[$this->alias]['customer_address'],
                'region_id' => $region_id,
                'region_name' => $v[$this->alias]['region_name'],
                'code' => $v[$this->alias]['code'],
                'no' => $v[$this->alias]['no'],
                'total_qty' => $v[$this->alias]['total_qty'],
                'total_price' => $v[$this->alias]['total_price'],
                'notes' => $v[$this->alias]['notes'],
                'status' => $v[$this->alias]['status'],
                'order_id' => $v[$this->alias]['order_id'],
                'order_code' => $v[$this->alias]['order_code'],
                'created' => $v[$this->alias]['created'],
                'modified' => $v[$this->alias]['modified'],
            );

            // thực hiện parse lại cache_data
            $pretty_data[$k]['items'] = unserialize($v[$this->alias]['cache_data']);
        }

        $json_content = json_encode($pretty_data);
        return CacheCommon::write($cache_path, $json_content);
    }

    public function countPendingStatus() {
        return $this->find('count', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'status' => STATUS_PENDING,
                    ),
        ));
    }

    public function countProcessingStatus() {
        return $this->find('count', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'status' => STATUS_PROCESSING,
                    ),
        ));
    }

    public function countByCustomerId($customer_id, $conditions = array()) {
        $default_conditions = array(
            'customer_id' => $customer_id,
        );
        $conditions = Hash::merge($default_conditions, $conditions);
        $options = array(
            'recursive' => -1,
            'conditions' => $conditions,
            'fields' => array(
                'COUNT(*) AS counter'
            ),
        );
        $counter = $this->find('first', $options);

        return $counter[0]['counter'];
    }

    public function statsStatus($status, $options = array()) {
        $default_opts = array(
            'recursive' => -1,
            'group' => array(
                'region_id', 'distributor_id',
            ),
            'fields' => array(
                'region_id', 'region_name', 'distributor_id',
                'distributor_code', 'COUNT(id) AS count',
            ),
            'conditions' => array(
                'status' => $status,
            ),
        );
        $options = Hash::merge($default_opts, $options);
        return $this->find('all', $options);
    }

    public function stats($options = array()) {
        $default_opts = array(
            'recursive' => -1,
            'group' => array(
                'region_id', 'distributor_id', 'product_id'
            ),
            'fields' => array(
                'region_id', 'region_name', 'distributor_id',
                'distributor_code', 'COUNT(id) AS count', 'SUM(total_price) AS total_revernue'
            ),
            'conditions' => array(
                'status' => STATUS_SUCCESS,
            ),
        );
        $options = Hash::merge($default_opts, $options);
        return $this->find('all', $options);
    }

}
