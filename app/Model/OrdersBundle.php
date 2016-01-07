<?php

class OrdersBundle extends AppModel {

    public $useTable = 'orders_bundles';
    public $belongsTo = array(
        'Order' => array(
            'className' => 'Order',
        ),
    );

}
