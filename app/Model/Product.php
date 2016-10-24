<?php

class Product extends AppModel {

    public $useTable = 'products';
    public $file_fields = array('logo', 'thumb');
    public $cached = 1;
    public $prev_data = array();
    public $actsAs = array(
        'FileCommon',
        'HABTMCommon',
        'RegionCommon',
        'ManagerFilter',
    );

//    public $hasAndBelongsToMany = array(
//        'Category' =>
//        array(
//            'className' => 'Category',
//            'joinTable' => 'products_categories',
//            'foreignKey' => 'product_id',
//            'associationForeignKey' => 'category_id',
//            'unique' => 'keepExisting',
//            'conditions' => '',
//            'fields' => '',
//            'order' => '',
//            'limit' => '',
//            'offset' => '',
//            'finderQuery' => '',
//            'with' => 'ProductsCategory',
//        )
//    );

    public function beforeSave($options = array()) {
        parent::beforeSave($options);

        if (isset($this->data[$this->alias]['distributor_id'])) {
            App::uses('Distributor', 'Model');
            $Distributor = new Distributor();
            $distributor_id = $this->data[$this->alias]['distributor_id'];
            $distributor = $Distributor->findById($distributor_id);
            $this->data[$this->alias]['distributor_code'] = !empty($distributor[$Distributor->alias]['code']) ?
                    $distributor[$Distributor->alias]['code'] : '';
        }
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

    public function afterDelete() {
        parent::afterDelete();

        if ($this->cached) {
            $this->data = $this->prev_data;
            $this->resetCache();
        }

//        if (!empty($this->prev_data)) {
//            // Thực hiện xóa cache file
//            App::uses('CacheCommon', 'Lib');
//            $region_id = $this->prev_data[$this->alias]['region_id'];
//            $category_id = $this->prev_data[$this->alias]['category_id'];
//            $cache_path = APP . Configure::read('saya.Product.cache_path');
//            $cache_file = $cache_path . $region_id . '_' . $category_id . '.json';
//
//            CacheCommon::delete($cache_file);
//        }
    }

    public function getByRegionCategory($region_id, $category_id) {

        return $this->find('all', array(
                    'recursive' => -1,
                    'conditions' => array(
                        $this->alias . '.status' => 2,
                        $this->alias . '.region_id' => $region_id,
                        $this->alias . '.category_id' => $category_id,
                    ),
                    'order' => array(
                        $this->alias . '.weight' => 'ASC',
                        $this->alias . '.modified' => 'DESC',
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
                'status' => STATUS_PUBLIC,
            ),
            'order' => array(
                'weight' => 'ASC',
                'modified' => 'DESC',
            ),
        ));

        $Caetgory = new Category();
        $categories = $Caetgory->find('all', array(
            'conditions' => array(
                'status' => STATUS_PUBLIC,
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

        if (empty($this->data[$this->alias]['region_id']) || empty($this->data[$this->alias]['category_id'])) {
            return true;
        }

        $region_ids = $category_ids = array();
        if (!empty($this->prev_data) && !empty($this->data[$this->alias]['region_id'])) {
            $prev_region_id = $this->prev_data[$this->alias]['region_id'];
            $region_id = $this->data[$this->alias]['region_id'];
            $region_ids[$prev_region_id] = $prev_region_id;
            $region_ids[$region_id] = $region_id;

            $prev_category_id = $this->prev_data[$this->alias]['category_id'];
            $category_ids[$prev_category_id] = $prev_category_id;
            $category_id = $this->data[$this->alias]['category_id'];
            $category_ids[$category_id] = $category_id;

            $this->resetCacheByRegion($region_ids, $category_ids, $cache_path);
        } elseif (!empty($this->data[$this->alias]['region_id'])) {
            $region_id = $this->data[$this->alias]['region_id'];
            $region_ids[$region_id] = $region_id;

            $category_id = $this->data[$this->alias]['category_id'];
            $category_ids[$category_id] = $category_id;

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

    public function removeCacheByRegion($region_ids, $category_ids) {
        $cache_path = APP . Configure::read('saya.Product.cache_path');
        foreach ($region_ids as $v) {
            foreach ($category_ids as $vv) {
                $cache_file = $cache_path . $v . '_' . $vv . '.json';
                if (file_exists($cache_file)) {
                    unlink($cache_file);
                }
            }
        }
    }

}
