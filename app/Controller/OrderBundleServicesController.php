<?php

App::uses('ServiceAppController', 'Controller');

class OrderBundleServicesController extends ServiceAppController {

    public $uses = array(
        'Order',
        'OrdersProduct',
        'OrdersBundle',
        'Customer',
        'Product',
    );
    public $debug_mode = 3;

    const ORDER_CODE_DELIMITER = 'N';

}
