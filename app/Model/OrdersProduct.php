<?php

class OrdersProduct extends AppModel {

    public $useTable = 'orders_products';
    public $belongsTo = array(
        'Order' => array(
            'className' => 'Order',
        ),
        'OrdersBundle' => array(
            'className' => 'OrdersBundle',
        ),
    );

}
