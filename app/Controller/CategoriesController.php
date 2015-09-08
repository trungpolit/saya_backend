<?php

class CategoriesController extends AppController {

    public $uses = array('Category');

    public function add() {

        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('category_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('category_title'));
    }

    protected function setInit() {

        $this->set('model_name', $this->modelClass);
        $this->set('status', Configure::read('saya.App.status'));
    }

}
