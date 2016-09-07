<?php

class Category extends AppModel {

    public $useTable = 'categories';
    public $file_fields = array('logo');
    public $actsAs = array(
        'FileCommon',
    );
    public $cached = 1;
    public $prev_data = array();

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
        // Nếu thực hiện thay đổi gán region_id, thì bỏ gán product vào category hiện tại
        if (
                isset($this->data[$this->alias]['region_id']) &&
                $this->data[$this->alias]['region_id'] != $this->prev_data[$this->alias]['region_id']
        ) {
            $category_id = $this->id;
            App::uses('Product', 'Model');
            $Product = new Product();
            $products = $Product->findAllByCategoryId($category_id);
            if (empty($products)) {
                return true;
            }
            $save_data = array();
            $category_ids = array($category_id);
            $region_ids = array();
            foreach ($products as $k => $v) {
                $save_data[$k] = $v[$Product->alias];
                $save_data[$k]['category_id'] = 0;
                $region_ids[] = $v[$Product->alias]['region_id'];
            }
            $Product->saveAll($save_data);

            // Thực hiện xóa cache
            $Product->removeCacheByRegion($region_ids, $category_ids);
        }

        return true;
    }

    public function afterDelete() {
        parent::afterDelete();

        if ($this->cached) {
            $this->resetCache();
        }
    }

    public function cache() {
        App::uses('Region', 'Model');
        App::uses('CacheCommon', 'Lib');
        $cache_path = APP . Configure::read('saya.Category.cache_path');
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
        $cache_path = APP . Configure::read('saya.Category.cache_path');

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
            $raw_categories = $this->findAllByRegionId($v);
            $categories = Hash::extract($raw_categories, '{n}.' . $this->alias);
            CacheCommon::parseFileUri($categories, $this->file_fields);
            $cache_file = $cache_path . $v . '.json';

            CacheCommon::write($cache_file, json_encode($categories));
        }
    }

}
