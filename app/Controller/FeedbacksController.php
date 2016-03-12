<?php

class FeedbacksController extends AppController {

    public $uses = array('Feedback');

    public function index() {

        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('feedback_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('feedback_title'));

        $options = array(
            'order' => array(
                'modified' => 'DESC',
            ),
        );

        $this->setSearchConds($options);

        $this->Paginator->settings = $options;
        $list_data = $this->Paginator->paginate($this->modelClass);
        $this->set('list_data', $list_data);
    }

    protected function setSearchConds(&$options) {

        if (isset($this->request->query['keyword']) && strlen(trim($this->request->query['keyword']))) {

            $this->request->query['keyword'] = trim($this->request->query['keyword']);
            $options['conditions']['OR']['LOWER(Feedback.name) LIKE'] = '%' . strtolower($this->request->query['keyword']) . '%';
            $options['conditions']['OR']['LOWER(Feedback.description) LIKE'] = '%' . strtolower($this->request->query['keyword']) . '%';
        }
        if (isset($this->request->query['created_start']) && strlen(trim($this->request->query['created_start']))) {

            $this->request->query['created_start'] = trim($this->request->query['created_start']);
            $options['conditions']['Feedback.created >='] = date('Y-m-d H:i:s', strtotime($this->request->query['created_start']));
        }
        if (isset($this->request->query['created_end']) && strlen(trim($this->request->query['created_end']))) {

            $this->request->query['created_end'] = trim($this->request->query['created_end']);
            $options['conditions']['Feedback.created <='] = date('Y-m-d H:i:s', strtotime($this->request->query['created_end']));
        }
    }

    protected function setInit() {

        $this->set('model_name', $this->modelClass);
    }

}
