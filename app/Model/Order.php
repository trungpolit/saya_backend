<?php

App::uses('CacheCommon', 'Lib');

class Order extends AppModel {

    public $useTable = 'orders';
    public $cached = 1;
    public $hasMany = array(
        'OrdersProduct' => array(
            'className' => 'OrdersProduct',
        ),
        'OrdersBundle' => array(
            'className' => 'OrdersBundle',
        ),
    );

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);

        if (
                !empty($this->data[$this->alias]['customer_code']) &&
                !empty($this->data[$this->alias]['no']) &&
                $this->cached
        ) {

            $page = ceil($this->data[$this->alias]['no'] / ORDER_LIMIT);
            $this->cacheByCustomerPage($this->data[$this->alias]['customer_code'], $page);
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
                'region_id' => $region_id,
                'region_name' => $v[$this->alias]['region_name'],
                'code' => $v[$this->alias]['code'],
                'no' => $v[$this->alias]['no'],
                'total_qty' => $v[$this->alias]['total_qty'],
                'total_price' => $v[$this->alias]['total_price'],
                'notes' => $v[$this->alias]['notes'],
            );

            // thực hiện parse lại cache_data
            $pretty_data[$k]['items'] = unserialize($v[$this->alias]['cache_data']);
        }

        $json_content = json_encode($pretty_data);
        return CacheCommon::write($cache_path, $json_content);
    }

}
