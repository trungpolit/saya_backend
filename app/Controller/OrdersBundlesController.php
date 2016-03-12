<?php

App::uses('AppController', 'Controller');

class OrdersBundlesController extends AppController {

    public $uses = array(
        'OrdersBundle',
        'Customer',
        'Bundle',
        'Region',
    );

    public function index() {

        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('orders_bundle_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('orders_bundle_title'));

        $options = array(
            'recursive' => -1,
            'order' => array(
                'created' => 'DESC',
            ),
        );

        $this->setSearchConds($options);

        $this->Paginator->settings = $options;
        $list_data = $this->Paginator->paginate($this->modelClass);

        // lấy ra thông tin tất cả nhóm Bundle
        $bundles = $this->Bundle->getList();
        $this->set('bundles', $bundles);

        // lấy ra danh sách region theo dạng tree phân cấp
        $regionTree = $this->Region->getTree();
        $this->set('regionTree', $regionTree);

        // lấy tổng số đơn hàng đang chờ xử lý
        $count_pending_status = $this->OrdersBundle->countPendingStatus();
        $this->set('count_pending_status', $count_pending_status);

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

            $options['conditions']['OrdersBundle.region_id'] = $this->request->query['region_id'];
        }
        if (isset($this->request->query['bundle_id']) && strlen($this->request->query['bundle_id'])) {

            $options['conditions']['OrdersBundle.bundle_id'] = $this->request->query['bundle_id'];
        }
        if (isset($this->request->query['code']) && strlen(trim($this->request->query['code']))) {

            $this->request->query['code'] = trim($this->request->query['code']);
            $options['conditions']['LOWER(OrdersBundle.code) LIKE'] = '%' . strtolower($this->request->query['code']) . '%';
        }
        if (isset($this->request->query['status']) && strlen($this->request->query['status'])) {

            $options['conditions']['OrdersBundle.status'] = $this->request->query['status'];
        }
        if (isset($this->request->query['created_start']) && strlen(trim($this->request->query['created_start']))) {

            $this->request->query['created_start'] = trim($this->request->query['created_start']);
            $options['conditions']['OrdersBundle.created >='] = date('Y-m-d H:i:s', strtotime($this->request->query['created_start']));
        }
        if (isset($this->request->query['created_end']) && strlen(trim($this->request->query['created_end']))) {

            $this->request->query['created_end'] = trim($this->request->query['created_end']);
            $options['conditions']['OrdersBundle.created <='] = date('Y-m-d H:i:s', strtotime($this->request->query['created_end']));
        }
        if (isset($this->request->query['customer_id']) && strlen(trim($this->request->query['customer_id']))) {

            $this->request->query['customer_id'] = trim($this->request->query['customer_id']);
            $options['conditions']['OrdersBundle.customer_id'] = $this->request->query['customer_id'];
        }
        if (isset($this->request->query['customer_name']) && strlen(trim($this->request->query['customer_name']))) {

            $this->request->query['customer_name'] = trim($this->request->query['customer_name']);
            $options['conditions']['LOWER(OrdersBundle.customer_name) LIKE'] = '%' . strtolower($this->request->query['customer_name']) . '%';
        }
        if (isset($this->request->query['customer_mobile']) && strlen(trim($this->request->query['customer_mobile']))) {

            $this->request->query['customer_mobile'] = trim($this->request->query['customer_mobile']);
            $options['conditions']['OR'][]['LOWER(OrdersBundle.customer_mobile) LIKE'] = '%' . strtolower($this->request->query['customer_mobile']) . '%';
            $options['conditions']['OR'][]['LOWER(OrdersBundle.customer_mobile2) LIKE'] = '%' . strtolower($this->request->query['customer_mobile']) . '%';
        }
        if (isset($this->request->query['customer_address']) && strlen(trim($this->request->query['customer_address']))) {

            $this->request->query['customer_address'] = trim($this->request->query['customer_address']);
            $options['conditions']['OR'][]['LOWER(OrdersBundle.customer_address) LIKE'] = '%' . strtolower($this->request->query['customer_address']) . '%';
        }
    }

    protected function setInit() {

        $this->set('model_name', $this->modelClass);
        $this->set('status', Configure::read('saya.Order.status'));
        $this->set('status_customer', Configure::read('saya.Customer.status'));
    }

    public function edit($id = null) {

        $this->{$this->modelClass}->id = $id;
        if (!$this->{$this->modelClass}->exists()) {

            throw new NotFoundException(__('invalid_data'));
        }
    }

}
