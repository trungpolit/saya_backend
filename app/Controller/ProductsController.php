<?php

class ProductsController extends AppController {

    public $uses = array(
        'Product',
        'Region',
        'Bundle',
        'Category',
    );

    public function add() {

        $this->setInit();
        $this->setList();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('product_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('product_title'));

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
        $this->setList();

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

            $product = $this->{$this->modelClass}->find('first', array(
                'conditions' => array(
                    'id' => $id,
                ),
                'recursive' => -1,
            ));
            $this->request->data = $product;
        }

        $this->render('add');
    }

    public function index() {

        $this->setInit();
        $this->setList();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('product_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('product_title'));

        $options = array(
            'order' => array(
                'modified' => 'DESC',
            ),
            'recursive' => -1,
        );
        $this->Paginator->settings = $options;
        $list_data = $this->Paginator->paginate($this->modelClass);

        $this->set('list_data', $list_data);
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

        $bundles = $this->Bundle->getList();
        $this->set('bundles', $bundles);

        $categories = $this->Category->getList();
        $this->set('categories', $categories);
    }

}
