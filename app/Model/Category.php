<?php

class Category extends AppModel {

    public $useTable = 'categories';
    public $file_fields = array('logo');
    public $actsAs = array('FileCommon');
    public $cached = 0;
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

    public function cache() {

        App::uses('CacheCommon', 'Lib');
        $cache_path = APP . Configure::read('saya.App.cache_path') . $this->useTable . '.json';

        $categories = $this->find('all', array(
            'recursive' => -1,
            'conditions' => array(
                'status' => 2,
            ),
            'order' => array(
                'weight' => 'ASC',
                'modified' => 'DESC',
            ),
        ));

        $json = Hash::extract($categories, '{n}.' . $this->alias);
        $json_content = json_encode($json);

        return CacheCommon::write($cache_path, $json_content);
    }

}
