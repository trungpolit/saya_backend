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
//        'ManagerFilter',
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

    public function getByRegionCategory($region_id, $category_id) {

        return $this->find('all', array(
                    'recursive' => -1,
                    'conditions' => array(
                        $this->alias . '.status' => 2,
                        $this->alias . '.region_id' => $region_id,
                        'ProductsCategory.category_id' => $category_id,
                    ),
                    'order' => array(
                        $this->alias . '.weight' => 'ASC',
                        $this->alias . '.modified' => 'DESC',
                    ),
                    'joins' => array(
                        array(
                            'table' => 'products_categories',
                            'alias' => 'ProductsCategory',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'ProductsCategory.product_id = ' . $this->alias . '.id',
                            )
                        )
                    ),
        ));
    }

    public function cache() {

        App::uses('Region', 'Model');
        App::uses('Category', 'Model');
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

        $Caetgory = new Category();
        $categories = $Caetgory->find('all', array(
            'conditions' => array(
                'status' => 2,
            ),
            'order' => array(
                'weight' => 'ASC',
                'modified' => 'DESC',
            ),
        ));

        if (empty($regions) || empty($categories)) {

            return true;
        }

        $region_ids = array();
        foreach ($regions as $v) {

            $region_ids[] = $v['Region']['id'];
        }

        $category_ids = array();
        foreach ($categories as $v) {

            $category_ids[] = $v['Category']['id'];
        }

        $this->resetCacheByRegion($region_ids, $category_ids, $cache_path);
    }

    protected function resetCache() {

        App::uses('CacheCommon', 'Lib');
        $cache_path = APP . Configure::read('saya.Product.cache_path');

        $region_ids = $category_ids = array();
        if (!empty($this->prev_data) && !empty($this->data[$this->alias]['region_id'])) {

            $prev_region_id = $this->prev_data[$this->alias]['region_id'];
            $region_id = $this->data[$this->alias]['region_id'];
            $region_ids[$prev_region_id] = $prev_region_id;
            $region_ids[$region_id] = $region_id;

            $prev_category_id = $this->prev_data[$this->alias]['category_id'];
            $category_id = $this->data[$this->alias]['category_id'];
            $category_ids = array_unique($category_ids + $prev_category_id + $category_id);

            $this->resetCacheByRegion($region_ids, $category_ids, $cache_path);
        } elseif (!empty($this->data[$this->alias]['region_id'])) {

            $region_id = $this->data[$this->alias]['region_id'];
            $region_ids[$region_id] = $region_id;

            $category_id = $this->data[$this->alias]['category_id'];
            $category_ids = array_unique($category_ids + $category_id);

            $this->resetCacheByRegion($region_ids, $category_ids, $cache_path);
        }
    }

    protected function resetCacheByRegion($region_ids, $category_ids, $cache_path) {

        foreach ($region_ids as $v) {

            foreach ($category_ids as $vv) {

                $raw_products = $this->getByRegionCategory($v, $vv);
                $products = Hash::extract($raw_products, '{n}.' . $this->alias);
                CacheCommon::parseFileUri($products, $this->file_fields);
                $cache_file = $cache_path . $v . '_' . $vv . '.json';

                CacheCommon::write($cache_file, json_encode($products));
            }
        }
    }

}
