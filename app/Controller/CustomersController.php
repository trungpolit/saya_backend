<?php

class CustomersController extends AppController {

    public $uses = array(
        'Customer',
        'OrdersBundle',
        'Region',
        'Bundle',
    );

    public function detail($id = null) {

        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('customer_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('customer_title'));

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->{$this->modelClass}->save($this->request->data[$this->modelClass]);
        }

        $customer = $this->{$this->modelClass}->findById($id);
        if (empty($customer)) {

            throw new NotImplementedException(__('The customer with id=%s does not exist.', $id));
        }
        $this->setCustomerStats($customer);
        $this->set('customer', $customer);

        // lấy ra thông tin tất cả nhóm Bundle
        $bundles = $this->Bundle->getList();
        $this->set('bundles', $bundles);

        // lấy ra danh sách region theo dạng tree phân cấp
        $regionTree = $this->Region->getList();
        $this->set('regionTree', $regionTree);

        // lấy ra danh sách các order của Customer
        $options = array(
            'recursive' => -1,
            'order' => array(
                'created' => 'DESC',
            ),
            'conditions' => array(
                'customer_id' => $id,
            ),
        );

        $this->setSearchConds($options);

        $this->Paginator->settings = $options;
        $list_data = $this->Paginator->paginate($this->OrdersBundle);

        // unserialize thông tin chứa trong cache_data
        $this->unserializeCacheData($list_data);

        $this->set('list_data', $list_data);
        $this->set('id', $id);
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

    protected function unserializeCacheData(&$list_data) {

        if (empty($list_data)) {

            return;
        }
        foreach ($list_data as $k => $v) {

            $list_data[$k]['OrdersBundle']['product_data'] = unserialize($v['OrdersBundle']['cache_data']);
        }
    }

    protected function setCustomerStats(&$customer) {

        if (empty($customer)) {

            return;
        }

        $user = $this->Auth->user();
        if (empty($user) || $user['type'] != MANAGER_TYPE) {

            return;
        }

        $customer_id = $customer[$this->modelClass]['id'];

        $total_order_bundle = $this->OrdersBundle->countByCustomerId($customer_id);
        $customer[$this->modelClass]['total_order_bundle'] = $total_order_bundle;

        $total_order_bundle_success = $this->OrdersBundle->countByCustomerId($customer_id, array(
            'status' => STATUS_SUCCESS,
        ));
        $customer[$this->modelClass]['total_order_bundle_success'] = $total_order_bundle_success;

        $total_order_bundle_pending = $this->OrdersBundle->countByCustomerId($customer_id, array(
            'status' => STATUS_PENDING,
        ));
        $customer[$this->modelClass]['total_order_bundle_pending'] = $total_order_bundle_pending;

        $total_order_bundle_processing = $this->OrdersBundle->countByCustomerId($customer_id, array(
            'status' => STATUS_PROCESSING,
        ));
        $customer[$this->modelClass]['total_order_bundle_processing'] = $total_order_bundle_processing;

        $total_order_bundle_fail = $this->OrdersBundle->countByCustomerId($customer_id, array(
            'status' => STATUS_FAIL,
        ));
        $customer[$this->modelClass]['total_order_bundle_fail'] = $total_order_bundle_fail;

        $total_order_bundle_bad = $this->OrdersBundle->countByCustomerId($customer_id, array(
            'status' => STATUS_BAD,
        ));
        $customer[$this->modelClass]['total_order_bundle_bad'] = $total_order_bundle_bad;
    }

    protected function setInit() {

        $this->set('model_name', $this->modelClass);
        $this->set('status_order', Configure::read('saya.Order.status'));
        $this->set('status', Configure::read('saya.Customer.status'));
    }

}
