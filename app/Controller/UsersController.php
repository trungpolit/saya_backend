<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $uses = array(
        'User',
        'UsersBundle',
        'UsersRegion',
        'Role',
        'Region',
        'Bundle',
    );

    public function index() {

        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('user_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('user_title'));

        $options = array(
            'recursive' => -1,
            'order' => array(
                'modified' => 'DESC',
            ),
        );

        $this->Paginator->settings = $options;
        $list_data = $this->Paginator->paginate($this->modelClass);
        $this->set('list_data', $list_data);
    }

    public function add() {

        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('user_title'),
        );
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => __FUNCTION__)),
            'label' => __('add_action_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('user_add_title'));

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

        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('user_title'),
        );
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => __FUNCTION__)),
            'label' => __('edit_action_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('user_edit_title'));

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

            $this->setUsersBundle($data, $id);
            $this->setUsersRegion($data, $id);

            $this->request->data = $data;
        }

        $this->render('add');
    }

    protected function setUsersRegion(&$data, $id) {

        if (empty($data)) {

            return;
        }

        $users_region = $this->UsersRegion->findAllByUserId($id);
        if (empty($users_region)) {

            $data[$this->modelClass]['region_id'] = array();
        } else {

            $region_id = Hash::extract($users_region, '{n}.UsersRegion.region_id');
            $data[$this->modelClass]['region_id'] = $region_id;
        }
    }

    protected function setUsersBundle(&$data, $id) {

        if (empty($data)) {

            return;
        }

        $users_bundle = $this->UsersBundle->findAllByUserId($id);
        if (empty($users_bundle)) {

            $data[$this->modelClass]['bundle_id'] = array();
        } else {

            $bundle_id = Hash::extract($users_bundle, '{n}.UsersBundle.bundle_id');
            $data[$this->modelClass]['bundle_id'] = $bundle_id;
        }
    }

    protected function setInit() {

        $this->set('model_name', $this->modelClass);
        $this->set('status', Configure::read('saya.App.status'));

        $roles = $this->Role->getList();
        $this->set('roles', $roles);

        $bundles = $this->Bundle->getList();
        $this->set('bundles', $bundles);

        $regionTree = $this->Region->getTree();
        $this->set('regionTree', $regionTree);
    }

}
