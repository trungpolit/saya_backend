<?php

class Order extends AppModel {

    public $useTable = 'orders';
    public $hasMany = array(
        'OrdersProduct' => array(
            'className' => 'OrdersProduct',
        ),
        'OrdersBundle' => array(
            'className' => 'OrdersBundle',
        ),
    );

}
