<?php

App::uses('AppController', 'Controller');

class NotificationsController extends AppController {

    public $uses = array(
        'Notification',
        'Region',
    );

    public function add() {

        $this->setInit();
        $this->setList();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('notification_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('notification_title'));

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->{$this->modelClass}->cached = 1;
            if ($this->{$this->modelClass}->save($this->request->data[$this->modelClass])) {

                $this->Session->setFlash(__('save_successful_message'), 'default', array(), 'good');
//                $this->redirect(array('action' => 'index'));
            } else {

                $this->Session->setFlash(__('save_error_message'), 'default', array(), 'bad');
            }
        }
    }

    public function edit() {
        
    }

    public function index() {
        
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
    }

}
