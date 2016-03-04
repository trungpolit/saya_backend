<?php

App::uses('AppController', 'Controller');

class PermsController extends AppController {

    public $uses = array('Perm');
    public $components = array('ControllerList');

    public function refresh() {

        $permissions = $this->ControllerList->getPermissions();
        if (empty($permissions)) {

            throw new CakeException(__('Can not auto generate any permissions'));
        }

        $save_data = array();
        foreach ($permissions as $key => $perm) {

            foreach ($perm as $v) {

                $exist = $this->{$this->modelClass}->getInfoByCode($v);
                if (!empty($exist)) {

                    continue;
                }

                $module = $key;
                $save_data[] = array(
                    'name' => $v,
                    'code' => $v,
                    'module' => $module,
                );
            }
        }

        if (empty($save_data)) {

            $this->Session->setFlash(__('nothing_changes_message'), 'default', array(), 'good');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->{$this->modelClass}->saveAll($save_data)) {

            $this->Session->setFlash(__('save_successful_message'), 'default', array(), 'good');
            $this->redirect(array('action' => 'index'));
        } else {

            $this->Session->setFlash(__('save_error_message'), 'default', array(), 'bad');
            $this->redirect(array('action' => 'index'));
        }
    }

    public function add() {

        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('perm_title'),
        );
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'add')),
            'label' => __('add_action_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('perm_title'));

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
            'label' => __('perm_title'),
        );
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'edit', $id)),
            'label' => __('edit_action_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('perm_title'));

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->{$this->modelClass}->save($this->request->data[$this->modelClass])) {

                $this->Session->setFlash(__('save_successful_message'), 'default', array(), 'good');
                $this->redirect(array('action' => 'index'));
            } else {

                $this->Session->setFlash(__('save_error_message'), 'default', array(), 'bad');
            }
        } else {

            $category = $this->{$this->modelClass}->find('first', array(
                'conditions' => array(
                    'id' => $id,
                ),
            ));
            $this->request->data = $category;
        }

        $this->render('add');
    }

    public function index() {

        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('perm_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('perm_title'));

        $options = array(
            'recursive' => -1,
        );
        $options['order'] = array('modified' => 'DESC');
        $this->setSearchConds($options);

        $this->Paginator->settings = $options;

        $list_data = $this->Paginator->paginate($this->modelClass);
        $this->set('list_data', $list_data);
    }

    protected function setSearchConds(&$options) {

        if (isset($this->request->query['name']) && strlen(trim($this->request->query['name']))) {

            $this->request->query['name'] = trim($this->request->query['name']);
            $options['conditions']['LOWER(Perm.name) LIKE'] = '%' . strtolower($this->request->query['name']) . '%';
        }
        if (isset($this->request->query['code']) && strlen(trim($this->request->query['code']))) {

            $this->request->query['code'] = trim($this->request->query['code']);
            $options['conditions']['LOWER(Perm.code) LIKE'] = '%' . strtolower($this->request->query['code']) . '%';
        }
        if (isset($this->request->query['module']) && strlen(trim($this->request->query['module']))) {

            $this->request->query['module'] = trim($this->request->query['module']);
            $options['conditions']['LOWER(Perm.module) LIKE'] = '%' . strtolower($this->request->query['module']) . '%';
        }
    }

    protected function setInit() {

        $this->set('model_name', $this->modelClass);
    }

}
