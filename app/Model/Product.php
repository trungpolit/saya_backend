<?php

class Product extends AppModel {

    public $useTable = 'products';
    public $file_fields = array('logo');
    public $cached = 1;
    public $prev_data = array();
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

    public function beforeSave($options = array()) {
        parent::beforeSave($options);

        if ($this->cached && !empty($this->data[$this->alias]['id'])) {

            $this->prev_data = $this->find('first', array(
                'conditions' => array(
                    'id' => $this->data[$this->alias]['id'],
                ),
                'recursive' => -1,
            ));
        }
    }

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);

        if ($this->cached) {

            $this->resetCache();
        }
    }

    public function getByRegion($region_id) {

        return $this->find('all', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'status' => 2,
                        'region_id' => $region_id,
                    ),
        ));
    }

    public function cache() {

        App::uses('Region', 'Model');
        App::uses('CacheCommon', 'Lib');
        $cache_path = APP . Configure::read('saya.Product.cache_path');
        $Region = new Region();
        $regions = $Region->find('all', array(
            'conditions' => array(
                'status' => 2,
            ),
            'order' => array(
                'weight' => 'ASC',
                'modified' => 'DESC',
            ),
        ));
        if (empty($regions)) {

            return true;
        }

        $region_ids = array();
        foreach ($regions as $v) {

            $region_ids[] = $v['Region']['id'];
        }
        $this->resetCacheByRegion($region_ids, $cache_path);
    }

    protected function resetCache() {

        App::uses('CacheCommon', 'Lib');
        $cache_path = APP . Configure::read('saya.Product.cache_path');

        $region_ids = array();
        if (!empty($this->prev_data) && !empty($this->data[$this->alias]['region_id'])) {

            $prev_region_id = $this->prev_data[$this->alias]['region_id'];
            $region_id = $this->data[$this->alias]['region_id'];
            $region_ids[$prev_region_id] = $prev_region_id;
            $region_ids[$region_id] = $region_id;

            $this->resetCacheByRegion($region_ids, $cache_path);
        } elseif (!empty($this->data[$this->alias]['region_id'])) {

            $region_id = $this->data[$this->alias]['region_id'];
            $region_ids[$region_id] = $region_id;

            $this->resetCacheByRegion($region_ids, $cache_path);
        }
    }

    protected function resetCacheByRegion($region_ids, $cache_path) {

        foreach ($region_ids as $v) {

            $raw_products = $this->getByRegion($v);
            $products = Hash::extract($raw_products, '{n}.' . $this->alias);
            $cache_file = $cache_path . $v . '.json';

            CacheCommon::write($cache_file, json_encode($products));
        }
    }

}
