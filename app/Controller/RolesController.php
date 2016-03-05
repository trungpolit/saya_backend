<?php

App::uses('AppController', 'Controller');

class RolesController extends AppController {

    public $uses = array(
        'Role',
        'Perm',
        'RolesPerm',
    );

    public function index() {

        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('role_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('role_title'));

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
            'label' => __('role_title'),
        );
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => __FUNCTION__)),
            'label' => __('add_action_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('role_add_title'));

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
            'label' => __('role_title'),
        );
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => __FUNCTION__)),
            'label' => __('edit_action_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('role_edit_title'));

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

            // Thực hiện set role và perm
            $this->setRolesPerm($data, $id);

            $this->request->data = $data;
        }

        $this->render('add');
    }

    protected function setRolesPerm(&$data, $id) {

        if (empty($data)) {

            return;
        }

        $roles_perm = $this->RolesPerm->findAllByRoleId($id);
        if (empty($roles_perm)) {

            $data[$this->modelClass]['perm_id'] = array();
        } else {

            $perm_id = Hash::extract($roles_perm, '{n}.RolesPerm.perm_id');
            $data[$this->modelClass]['perm_id'] = $perm_id;
        }
    }

    protected function setInit() {

        $this->set('model_name', $this->modelClass);
        $this->set('status', Configure::read('saya.App.status'));

        $perms = $this->Perm->getList();
        $this->set('perms', $perms);
    }

}
