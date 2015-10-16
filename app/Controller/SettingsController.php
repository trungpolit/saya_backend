<?php

App::uses('AppController', 'Controller');

class SettingsController extends AppController {

    public $uses = array('Setting');

    public function index() {

        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('setting_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('setting_title'));

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

    public function reqEdit($id = null) {

        $this->{$this->modelClass}->cached = 1;

        parent::reqEdit($id);
    }

    protected function setInit() {

        $this->set('model_name', $this->modelClass);
        $this->set('editor_keys', Configure::read('saya.Settings.editor_keys'));
    }

}
