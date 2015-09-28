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
    }

    public function edit($id = null) {
        
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

        $options = array();
        $options['order'] = array('modified' => 'DESC');

        $this->Paginator->settings = $options;

        $list_data = $this->Paginator->paginate($this->modelClass);
        $this->set('list_data', $list_data);
    }

    protected function setInit() {

        $this->set('model_name', $this->modelClass);
    }

}
