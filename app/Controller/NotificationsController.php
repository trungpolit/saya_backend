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

        $this->setInit();
        $this->setList();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('notification_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('notification_title'));

        $options = array(
            'order' => array(
                'modified' => 'DESC',
            ),
        );

        $this->Paginator->settings = $options;
        $list_data = $this->Paginator->paginate($this->modelClass);
        $this->setRegionParentId($list_data);
        $this->set('list_data', $list_data);
    }

    public function reqEdit($id = null) {

        $this->{$this->modelClass}->cached = 1;
        parent::reqEdit($id);
    }

    protected function setRegionParentId(&$list_data) {

        if (empty($list_data)) {

            return;
        }

        $region_parent_ids = array();
        foreach ($list_data as $k => $v) {

            $region_id = $v[$this->modelClass]['region_id'];
            if (empty($region_parent_ids[$region_id])) {

                $region = $this->Region->find('first', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'id' => $region_id,
                    ),
                ));
                $region_parent_ids[$region_id] = $region['Region']['parent_id'];
            }
            $list_data[$k][$this->modelClass]['region_parent_id'] = $region_parent_ids[$region_id];
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
    }

}
