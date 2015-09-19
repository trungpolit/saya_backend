<?php

class Category extends AppModel {

    public $useTable = 'categories';
    public $file_fields = array('logo');
    public $actsAs = array('FileCommon');
    public $hasAndBelongsToMany = array(
        'Product' =>
        array(
            'className' => 'Product',
            'joinTable' => 'products_categories',
            'foreignKey' => 'category_id',
            'associationForeignKey' => 'product_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'with' => 'ProductsCategory',
        )
    );

}
