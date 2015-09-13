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

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->Category->save($this->request->data[$this->modelClass])) {

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
        $this->Category->file_proccess = 1;
        
        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('category_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('category_title'));

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->Category->save($this->request->data[$this->modelClass])) {

                $this->Session->setFlash(__('save_successful_message'), 'default', array(), 'good');
//                $this->redirect(array('action' => 'index'));
            } else {

                $this->Session->setFlash(__('save_error_message'), 'default', array(), 'bad');
            }
        } else {

            $category = $this->Category->find('first', array(
                'conditions' => array(
                    'id' => $id,
                ),
            ));
            $this->request->data = $category;
        }

        $this->render('add');
    }

    protected function setInit() {

        $this->set('model_name', $this->modelClass);
        $this->set('status', Configure::read('saya.App.status'));
    }

}
