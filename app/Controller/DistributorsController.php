<?php

App::uses('AppController', 'Controller');

class DistributorsController extends AppController {

    public $uses = array(
        'Distributor',
        'DistributorsRegion',
        'User',
        'Role',
        'Region',
    );

    public function index() {
        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('distributor_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('distributor_title'));

        $options = array(
            'recursive' => -1,
            'order' => array(
                'modified' => 'DESC',
            ),
        );
        $this->setSearchConds($options);
        $this->Paginator->settings = $options;
        $list_data = $this->Paginator->paginate($this->modelClass);

        $this->set('list_data', $list_data);
    }

    protected function setSearchConds(&$options) {
        if (isset($this->request->query['name']) && strlen(trim($this->request->query['name']))) {
            $this->request->query['name'] = trim($this->request->query['name']);
            $options['conditions']['LOWER(Distributor.name) LIKE'] = '%' . strtolower($this->request->query['name']) . '%';
        }
        if (isset($this->request->query['region_id']) && strlen($this->request->query['region_id'])) {
            $options['joins'] = array(
                array('table' => 'distributors_regions',
                    'alias' => 'DistributorsRegion',
                    'type' => 'INNER',
                    'conditions' => array(
                        'DistributorsRegion.distributor_id = Distributor.id',
                    )
                )
            );

            $options['conditions']['DistributorsRegion.region_id'] = $this->request->query['region_id'];
        }
        if (isset($this->request->query['status']) && strlen($this->request->query['status'])) {
            $options['conditions']['Distributor.status'] = $this->request->query['status'];
        }
        if (isset($this->request->query['id']) && strlen($this->request->query['id'])) {
            $options['conditions']['Distributor.id'] = $this->request->query['id'];
        }
        if (isset($this->request->query['code']) && strlen(trim($this->request->query['code']))) {
            $this->request->query['code'] = trim($this->request->query['code']);
            $options['conditions']['LOWER(Distributor.code) LIKE'] = '%' . strtolower($this->request->query['code']) . '%';
        }
    }

    public function add() {
        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('distributor_title'),
        );
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => __FUNCTION__)),
            'label' => __('add_action_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('distributor_add_title'));

        if ($this->request->is('post') || $this->request->is('put')) {
            // cưỡng ép kiểu user
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

        $this->setInit();
        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('distributor_title'),
        );
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => __FUNCTION__)),
            'label' => __('edit_action_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('distributor_edit_title'));

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->{$this->modelClass}->save($this->request->data[$this->modelClass])) {
                $this->Session->setFlash(__('save_successful_message'), 'default', array(), 'good');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('save_error_message'), 'default', array(), 'bad');
            }
        } else {
            $data = $this->{$this->modelClass}->find('first', array(
                'conditions' => array(
                    'id' => $id,
                ),
                'recursive' => -1,
            ));

            $this->request->data = $data;
        }
        $this->render('add');
    }

    /*
     * resetPassword
     * Thực hiện reset password
     */

    public function resetPassword($id = null) {
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->{$this->modelClass}->save($this->request->data[$this->modelClass])) {
                $this->Session->setFlash(__('reset_password_successful_message'), 'default', array(), 'good');
                $this->redirect(array('action' => 'edit', $id));
            } else {
                $this->Session->setFlash(__('reset_password_error_message'), 'default', array(), 'bad');
            }
        }
    }

    protected function setInit() {

        $this->set('model_name', $this->modelClass);
        $this->set('status', Configure::read('saya.App.status'));

        $regionTree = $this->Region->getTree();
        $this->set('regionTree', $regionTree);
    }

}
