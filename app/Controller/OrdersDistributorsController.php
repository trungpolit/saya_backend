<?php

App::uses('AppController', 'Controller');

class OrdersDistributorsController extends AppController {

    public $uses = array(
        'OrdersDistributor',
        'Customer',
        'Distributor',
        'Region',
        'Setting',
    );

    public function index() {
        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('orders_distributor_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('orders_distributor_title'));

        $options = array(
            'recursive' => -1,
            'order' => array(
                'created' => 'DESC',
            ),
        );

        $this->setSearchConds($options);

        $this->Paginator->settings = $options;
        $list_data = $this->Paginator->paginate($this->modelClass);

        // lấy ra thông tin tất cả nhóm Distributor
        $distributors = $this->Distributor->getList();
        $this->set('distributors', $distributors);

        // lấy ra danh sách region theo dạng tree phân cấp
        $regionTree = $this->Region->getTree();
        $this->set('regionTree', $regionTree);

        // lấy tổng số đơn hàng đang chờ xử lý
        $count_pending_status = $this->OrdersDistributor->countPendingStatus();
        $this->set('count_pending_status', $count_pending_status);

        // lấy tổng số đơn hàng đang xử lý
        $count_processing_status = $this->OrdersDistributor->countProcessingStatus();
        $this->set('count_processing_status', $count_processing_status);

        // Thực hiện lấy ra thông tin của Customer
        $this->setCustomerInfo($list_data);

        // unserialize thông tin chứa trong cache_data
        $this->unserializeCacheData($list_data);

        $this->set('list_data', $list_data);
    }

    protected function setCustomerInfo(&$list_data) {
        if (empty($list_data)) {
            return;
        }
        $customers = array();
        foreach ($list_data as $k => $v) {
            $customer_id = $v[$this->modelClass]['customer_id'];
            if (empty($customers[$customer_id])) {
                $customers[$customer_id] = $this->Customer->findById($customer_id);
            }
            $list_data[$k]['Customer'] = $customers[$customer_id]['Customer'];
        }
    }

    protected function unserializeCacheData(&$list_data) {
        if (empty($list_data)) {
            return;
        }
        foreach ($list_data as $k => $v) {
            $list_data[$k][$this->modelClass]['product_data'] = unserialize($v[$this->modelClass]['cache_data']);
        }
    }

    protected function setSearchConds(&$options) {
        if (isset($this->request->query['region_id']) && strlen($this->request->query['region_id'])) {
            $options['conditions']['OrdersDistributor.region_id'] = $this->request->query['region_id'];
        }
        if (isset($this->request->query['distributor_id']) && strlen($this->request->query['distributor_id'])) {
            $options['conditions']['OrdersDistributor.distributor_id'] = $this->request->query['distributor_id'];
        }
        if (isset($this->request->query['code']) && strlen(trim($this->request->query['code']))) {
            $this->request->query['code'] = trim($this->request->query['code']);
            $options['conditions']['LOWER(OrdersDistributor.code) LIKE'] = '%' . strtolower($this->request->query['code']) . '%';
        }
        if (isset($this->request->query['status']) && strlen($this->request->query['status'])) {
            $options['conditions']['OrdersDistributor.status'] = $this->request->query['status'];
        }
        if (isset($this->request->query['created_start']) && strlen(trim($this->request->query['created_start']))) {
            $this->request->query['created_start'] = trim($this->request->query['created_start']);
            $options['conditions']['OrdersDistributor.created >='] = date('Y-m-d H:i:s', strtotime($this->request->query['created_start']));
        }
        if (isset($this->request->query['created_end']) && strlen(trim($this->request->query['created_end']))) {
            $this->request->query['created_end'] = trim($this->request->query['created_end']);
            $options['conditions']['OrdersDistributor.created <='] = date('Y-m-d H:i:s', strtotime($this->request->query['created_end']));
        }
        if (isset($this->request->query['customer_id']) && strlen(trim($this->request->query['customer_id']))) {
            $this->request->query['customer_id'] = trim($this->request->query['customer_id']);
            $options['conditions']['OrdersDistributor.customer_id'] = $this->request->query['customer_id'];
        }
        if (isset($this->request->query['customer_name']) && strlen(trim($this->request->query['customer_name']))) {
            $this->request->query['customer_name'] = trim($this->request->query['customer_name']);
            $options['conditions']['LOWER(OrdersDistributor.customer_name) LIKE'] = '%' . strtolower($this->request->query['customer_name']) . '%';
        }
        if (isset($this->request->query['customer_mobile']) && strlen(trim($this->request->query['customer_mobile']))) {
            $this->request->query['customer_mobile'] = trim($this->request->query['customer_mobile']);
            $options['conditions']['OR'][]['LOWER(OrdersDistributor.customer_mobile) LIKE'] = '%' . strtolower($this->request->query['customer_mobile']) . '%';
            $options['conditions']['OR'][]['LOWER(OrdersDistributor.customer_mobile2) LIKE'] = '%' . strtolower($this->request->query['customer_mobile']) . '%';
        }
        if (isset($this->request->query['customer_address']) && strlen(trim($this->request->query['customer_address']))) {
            $this->request->query['customer_address'] = trim($this->request->query['customer_address']);
            $options['conditions']['OR'][]['LOWER(OrdersDistributor.customer_address) LIKE'] = '%' . strtolower($this->request->query['customer_address']) . '%';
        }
    }

    protected function setInit() {
        $this->set('model_name', $this->modelClass);
        $this->set('status', Configure::read('saya.Order.status'));
        $this->set('status_customer', Configure::read('saya.Customer.status'));
        // lấy ra thiết lập refresh
        $refresh_setting = $this->Setting->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'key' => 'DAILY_REPORT_REFRESH',
            ),
        ));
        $refresh = !empty($refresh_setting['Setting']) ?
                (int) $refresh_setting['Setting']['value'] : DAILY_REPORT_REFRESH;
        $this->set('refresh', $refresh);
    }

    public function edit($id = null) {
        $this->{$this->modelClass}->id = $id;
        if (!$this->{$this->modelClass}->exists()) {
            throw new NotFoundException(__('invalid_data'));
        }
    }

    public function reqDistributorByRegionId() {
        $this->layout = 'ajax';
        $this->setInit();
        $region_id = $this->request->query('region_id');
        $options = array(
            'fields' => array(
                'id', 'name',
            ),
            'conditions' => array(
                'Distributor.status' => STATUS_PUBLIC,
            ),
            'order' => array(
                'Distributor.weight' => 'ASC',
                'Distributor.modified' => 'DESC',
            ),
        );
        if (!empty($region_id)) {
            $options['joins'] = array(
                array('table' => 'distributors_regions',
                    'alias' => 'DistributorsRegion',
                    'type' => 'INNER',
                    'conditions' => array(
                        'DistributorsRegion.distributor_id = Distributor.id',
                    )
                )
            );
            $options['conditions']['DistributorsRegion.region_id'] = $region_id;
        }
        $distributors = $this->Distributor->find('list', $options);
        $this->set('distributors', $distributors);

        $disable_label = $this->request->query('disable_label');
        $this->set('disable_label', $disable_label);

        $action = $this->request->query('action');
        $this->set('action', $action);
    }

}
