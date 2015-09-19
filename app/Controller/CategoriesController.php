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

        $this->{$this->modelClass}->file_proccess = 1;

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->{$this->modelClass}->save($this->request->data[$this->modelClass])) {

                $this->Session->setFlash(__('save_successful_message'), 'default', array(), 'good');
//                $this->redirect(array('action' => 'index'));
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
        $this->{$this->modelClass}->file_proccess = 1;

        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('category_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('category_title'));

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->{$this->modelClass}->save($this->request->data[$this->modelClass])) {

                $this->Session->setFlash(__('save_successful_message'), 'default', array(), 'good');
//                $this->redirect(array('action' => 'index'));
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
            'label' => __('category_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('category_title'));

        $options = array(
            'order' => array(
                'modified' => 'DESC',
            ),
        );
        $this->Paginator->settings = $options;
        $list_data = $this->Paginator->paginate($this->modelClass);

        $this->set('list_data', $list_data);
    }

    protected function setInit() {

        $this->set('model_name', $this->modelClass);
        $this->set('status', Configure::read('saya.App.status'));
    }

}
