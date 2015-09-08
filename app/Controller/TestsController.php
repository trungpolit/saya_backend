<?php

App::uses('AppController', 'Controller');

class TestsController extends AppController {

    public $uses = array('Region');

    public function regionCache() {

        $this->Region->cache();

        $this->render('empty');
    }

}
