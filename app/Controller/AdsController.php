<?php

class AdsController extends AppController {

    public $uses = array('Ads');

    public function index() {

        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('ads_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('ads_title'));

        $options = array(
            'recursive' => -1,
            'order' => array(
                'created' => 'DESC',
            ),
        );
        $this->Paginator->settings = $options;
        $list_data = $this->Paginator->paginate($this->modelClass);

        $this->set('list_data', $list_data);
    }

    protected function setInit() {

        $this->set('model_name', $this->modelClass);
        $this->set('status', Configure::read('saya.Ads.status'));
    }

}
