<?php

class Product extends AppModel {

    public $useTable = 'products';
    public $file_fields = array('logo');
    public $actsAs = array(
        'FileCommon',
        'HABTMCommon',
        'RegionCommon',
    );
    public $hasAndBelongsToMany = array(
        'Category' =>
        array(
            'className' => 'Category',
            'joinTable' => 'products_categories',
            'foreignKey' => 'product_id',
            'associationForeignKey' => 'category_id',
            'unique' => 'keepExisting',
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
