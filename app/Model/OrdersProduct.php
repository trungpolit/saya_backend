<?php

class OrdersProduct extends AppModel {

    public $useTable = 'orders_products';
    public $belongsTo = array(
        'Order' => array(
            'className' => 'Order',
        ),
        'OrdersDistributor' => array(
            'className' => 'OrdersDistributor',
        ),
    );

    public function stats($options = array()) {
        $default_opts = array(
            'recursive' => -1,
            'group' => array(
                'region_id', 'distributor_id', 'product_id'
            ),
            'fields' => array(
                'region_id', 'region_name', 'distributor_id',
                'distributor_code', 'product_id', 'product_name',
                'SUM(qty) AS total_qty', 'SUM(total_price) AS total_revernue'
            ),
            'conditions' => array(
                'status' => STATUS_SUCCESS,
            ),
        );
        $options = Hash::merge($default_opts, $options);
        return $this->find('all', $options);
    }

}
