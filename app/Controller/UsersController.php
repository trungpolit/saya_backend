<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $uses = array(
        'User',
        'UsersBundle',
    );

}
