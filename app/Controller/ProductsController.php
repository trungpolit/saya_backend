<?php

class ProductsController extends AppController {

    public $uses = array(
        'Product',
        'Region',
        'Distributor',
        'Category',
    );

    public function add() {
        $this->setInit();
        $this->setList();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('product_title'),
        );
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => __FUNCTION__)),
            'label' => __('add_action_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('product_add_title'));

        $this->{$this->modelClass}->file_proccess = 1;
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->{$this->modelClass}->save($this->request->data[$this->modelClass])) {
                $this->Session->setFlash(__('save_successful_message'), 'default', array(), 'good');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('save_error_message'), 'default', array(), 'bad');
            }
        }
    }

    public function edit($id = null) {
        $this->{$this->modelClass}->id = $id;
        if (!$this->{$this->modelClass}->exists()) {
            throw new NotFoundException(__('invalid_data'));
        }

        $this->{$this->modelClass}->file_proccess = 1;

        $this->setInit();
        $this->setList();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('product_title'),
        );
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => __FUNCTION__, $id)),
            'label' => __('edit_action_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('product_edit_title'));

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->{$this->modelClass}->save($this->request->data[$this->modelClass])) {
                $this->Session->setFlash(__('save_successful_message'), 'default', array(), 'good');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('save_error_message'), 'default', array(), 'bad');
            }
        } else {
            $product = $this->{$this->modelClass}->find('first', array(
                'conditions' => array(
                    'id' => $id,
                ),
                'recursive' => -1,
            ));
            $this->request->data = $product;
        }

        $this->render('add');
    }

    public function index() {
        $this->setInit();
        $this->setList();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('product_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('product_title'));

        $options = array(
            'order' => array(
                'modified' => 'DESC',
            ),
            'recursive' => -1,
        );

        $this->setSearchConds($options);

        $this->Paginator->settings = $options;
        $list_data = $this->Paginator->paginate($this->modelClass);

        $this->unserializeLogoUri($list_data);

        $this->set('list_data', $list_data);
    }

    public function indexView() {
        $this->setInit();
        $this->setList();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => __FUNCTION__)),
            'label' => __('product_view_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('product_view_title'));

        $options = array(
            'order' => array(
                'modified' => 'DESC',
            ),
            'recursive' => -1,
        );

        // nếu user thuộc MANAGER_TYPE, thì thực hiện lọc
        $user = CakeSession::read('Auth.User');
        if ($user['type'] == MANAGER_TYPE) {
            $region_id = $user['region_id'];
            $distributor_id = $user['distributor_id'];
            $options['conditions']['region_id'] = $region_id;
            $options['conditions']['distributor_id'] = $distributor_id;

            // chỉ lọc ra các content có status là STATUS_PUBLIC
            $options['conditions']['status'] = STATUS_PUBLIC;
        }

        $this->setSearchConds($options);

        $this->Paginator->settings = $options;
        $list_data = $this->Paginator->paginate($this->modelClass);

        $this->unserializeLogoUri($list_data);

        $this->set('list_data', $list_data);
    }

    protected function unserializeLogoUri(&$list_data) {
        if (empty($list_data)) {
            return;
        }
        foreach ($list_data as $k => $v) {
            if (!empty($v[$this->modelClass]['logo_uri'])) {
                $list_data[$k][$this->modelClass]['logo_path'] = unserialize($v[$this->modelClass]['logo_uri'])[0];
            }
        }
    }

    protected function setInit() {
        $this->set('model_name', $this->modelClass);
        $this->set('status', Configure::read('saya.App.status'));
    }

    protected function setList() {
        $region_parents = $this->Region->getList(array(
            'conditions' => array(
                'parent_id' => null,
            ),
        ));
        $this->set('region_parents', $region_parents);

        $region_children = $this->Region->getList(array(
            'conditions' => array(
                'parent_id !=' => null,
            ),
        ));
        $this->set('region_children', $region_children);

        $distributors = $this->Distributor->getList();
        $this->set('distributors', $distributors);

        $categories = $this->Category->getList();
        $this->set('categories', $categories);

        $regionTree = $this->Region->getTree();
        $this->set('regionTree', $regionTree);
    }

    protected function setSearchConds(&$options) {
        if (isset($this->request->query['name']) && strlen(trim($this->request->query['name']))) {
            $this->request->query['name'] = trim($this->request->query['name']);
            $options['conditions']['LOWER(Product.name) LIKE'] = '%' . strtolower($this->request->query['name']) . '%';
        }
        if (isset($this->request->query['region_id']) && strlen($this->request->query['region_id'])) {
            $options['conditions']['Product.region_id'] = $this->request->query['region_id'];
        }
        if (isset($this->request->query['distributor_id']) && strlen($this->request->query['distributor_id'])) {
            $options['conditions']['Product.distributor_id'] = $this->request->query['distributor_id'];
        }
        if (isset($this->request->query['status']) && strlen($this->request->query['status'])) {
            $options['conditions']['Product.status'] = $this->request->query['status'];
        }
        if (isset($this->request->query['id']) && strlen($this->request->query['id'])) {
            $options['conditions']['Product.id'] = $this->request->query['id'];
        }
        if (isset($this->request->query['created_start']) && strlen(trim($this->request->query['created_start']))) {
            $this->request->query['created_start'] = trim($this->request->query['created_start']);
            $options['conditions']['Product.created >='] = date('Y-m-d H:i:s', strtotime($this->request->query['created_start']));
        }
        if (isset($this->request->query['created_end']) && strlen(trim($this->request->query['created_end']))) {
            $this->request->query['created_end'] = trim($this->request->query['created_end']);
            $options['conditions']['Product.created <='] = date('Y-m-d H:i:s', strtotime($this->request->query['created_end']));
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
    }

}
