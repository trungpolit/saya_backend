<?php

App::uses('AppController', 'Controller');

class RegionsController extends AppController {

    public $uses = array('Region');
    public $types = array('parent', 'child');
    public $type = null;

    public function add($type = 'parent') {

        $this->type = $type;
        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('region_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('region_title'));

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->{$this->modelClass}->save($this->request->data[$this->modelClass])) {

                $this->Session->setFlash(__('save_successful_message'), 'default', array(), 'good');
                $this->redirect(array('action' => 'index', $type));
            } else {

                $this->Session->setFlash(__('save_error_message'), 'default', array(), 'bad');
            }
        }

        $this->set('type', $type);
    }

    public function edit($type = 'parent', $id = null) {

        $this->type = $type;
        $this->{$this->modelClass}->id = $id;
        if (!$this->{$this->modelClass}->exists()) {

            throw new NotFoundException(__('invalid_data'));
        }

        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('region_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('region_title'));

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->{$this->modelClass}->save($this->request->data[$this->modelClass])) {

                $this->Session->setFlash(__('save_successful_message'), 'default', array(), 'good');
                $this->redirect(array('action' => 'index', $type));
            } else {

                $this->Session->setFlash(__('save_error_message'), 'default', array(), 'bad');
            }
        } else {

            $region = $this->{$this->modelClass}->find('first', array(
                'conditions' => array(
                    'id' => $id,
                ),
            ));
            $this->request->data = $region;
        }

        $this->set('type', $type);

        $this->render('add');
    }

    public function index($type = 'parent') {

        $this->type = $type;
        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('region_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('region_title'));

        $options = array(
            'order' => array(
                'modified' => 'DESC',
            ),
        );
        if ($this->type == 'parent') {

            $options['conditions']['parent_id'] = null;
        }
        if ($this->type == 'child') {

            $options['conditions']['parent_id !='] = null;
        }

        $this->Paginator->settings = $options;
        $list_data = $this->Paginator->paginate($this->modelClass);

        $this->set('list_data', $list_data);
        $this->set('type', $type);
    }

    protected function setInit() {

        $this->set('model_name', $this->modelClass);
        $this->set('status', Configure::read('saya.App.status'));

        if (!in_array($this->type, $this->types)) {

            throw new NotFoundException(__('invalid_data'));
        }

        if ($this->type == 'child') {

            $parents = $this->Region->getList(array(
                'conditions' => array(
                    'parent_id' => null,
                ),
            ));
            $this->set('parents', $parents);
        }
    }

    public function recover() {

        $this->autoRender = false;
        $this->Region->recover();
    }

    public function reorder() {

        $this->autoRender = false;
        $this->Region->reorder(array(
            'field' => 'weight',
        ));
    }

}
