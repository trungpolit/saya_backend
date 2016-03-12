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
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => __FUNCTION__)),
            'label' => __('add_action_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('notification_add_title'));

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->{$this->modelClass}->cached = 1;
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
        $this->setList();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('notification_title'),
        );
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => __FUNCTION__, $id)),
            'label' => __('edit_action_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('notification_edit_title'));

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->{$this->modelClass}->cached = 1;
            if ($this->{$this->modelClass}->save($this->request->data[$this->modelClass])) {

                $this->Session->setFlash(__('save_successful_message'), 'default', array(), 'good');
                $this->redirect(array('action' => 'index'));
            } else {

                $this->Session->setFlash(__('save_error_message'), 'default', array(), 'bad');
            }
        } else {

            $notification = $this->{$this->modelClass}->find('first', array(
                'conditions' => array(
                    'id' => $id,
                ),
                'recursive' => -1,
            ));
            $this->request->data = $notification;
        }

        $this->render('add');
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

        $this->setSearchConds($options);

        $this->Paginator->settings = $options;
        $list_data = $this->Paginator->paginate($this->modelClass);
        $this->setRegionParentId($list_data);
        $this->set('list_data', $list_data);
    }

    public function indexView() {

        $this->setInit();
        $this->setList();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('notification_view_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('notification_view_title'));

        $options = array(
            'order' => array(
                'modified' => 'DESC',
            ),
        );

        // nếu user thuộc MANAGER_TYPE, thì thực hiện lọc
        $user = CakeSession::read('Auth.User');
        if ($user['type'] == MANAGER_TYPE) {

            $region_id = $user['region_id'];
            $options['conditions']['region_id'] = $region_id;

            // chỉ lọc ra các content có status là STATUS_PUBLIC
            $options['conditions']['status'] = STATUS_PUBLIC;

            // chỉ lọc ra các thông báo còn hiệu lực
            $options['conditions']['Notification.end_at >='] = date('Y-m-d H:i:s');
        }

        $this->setSearchConds($options);

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

        $regionTree = $this->Region->getTree();
        $this->set('regionTree', $regionTree);

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

    protected function setSearchConds(&$options) {

        if (isset($this->request->query['name']) && strlen(trim($this->request->query['name']))) {

            $this->request->query['name'] = trim($this->request->query['name']);
            $options['conditions']['LOWER(Notification.name) LIKE'] = '%' . strtolower($this->request->query['name']) . '%';
        }
        if (isset($this->request->query['region_id']) && strlen($this->request->query['region_id'])) {

            $options['conditions']['Notification.region_id'] = $this->request->query['region_id'];
        }
        if (isset($this->request->query['status']) && strlen($this->request->query['status'])) {

            $options['conditions']['Notification.status'] = $this->request->query['status'];
        }
        if (isset($this->request->query['id']) && strlen($this->request->query['id'])) {

            $options['conditions']['Notification.id'] = $this->request->query['id'];
        }
        if (isset($this->request->query['end_at_start']) && strlen(trim($this->request->query['end_at_start']))) {

            $this->request->query['end_at_start'] = trim($this->request->query['end_at_start']);
            $options['conditions']['Notification.end_at >='] = date('Y-m-d H:i:s', strtotime($this->request->query['end_at_start']));
        }
        if (isset($this->request->query['end_at_end']) && strlen(trim($this->request->query['end_at_end']))) {

            $this->request->query['end_at_end'] = trim($this->request->query['end_at_end']);
            $options['conditions']['Notification.end_at <='] = date('Y-m-d H:i:s', strtotime($this->request->query['end_at_end']));
        }
    }

}
