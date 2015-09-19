<?php

App::uses('AppController', 'Controller');

class TestsController extends AppController {

    public $uses = array('Region', 'Category');

    public function regionCache() {

        $this->Region->cache();
        $this->render('empty');
    }

    public function categoryCache() {

        $this->Category->cache();
        $this->render('empty');
    }

}
