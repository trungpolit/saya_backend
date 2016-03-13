<?php

App::uses('UtilityCommon', 'Lib');

class Setting extends AppModel {

    public $useTable = 'settings';
    public $cached = 1;

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);

        if ($this->cached) {

            $this->updateSettingCache();
        }
    }

    public function afterDelete() {
        parent::afterDelete();

        if ($this->cached) {

            $this->updateSettingCache();
        }
    }

    public function cache() {

        App::uses('CacheCommon', 'Lib');
        $cache_path = APP . Configure::read('saya.App.cache_path') . $this->useTable . '.json';

        $settings = $this->getAll();

        // thực hiện merge với dữ liệu của Region
        $merge = $this->mergeRegion($settings);

        $json_content = json_encode($merge);

        return CacheCommon::write($cache_path, $json_content);
    }

    /**
     * mergeRegion
     * thực hiện hợp nhất dữ liệu setting với dữ liệu region
     * 
     * @param array $settings
     * @return array
     */
    protected function mergeRegion($settings) {

        App::uses('Region', 'Model');
        $Region = new Region();

        $region_parents = $Region->getListParents();
        $region_children = $Region->getListChildren();

        $region = array(
            $Region->useTable => array(
                'parent' => $region_parents,
                'child' => $region_children,
            ),
        );

        $merge = Hash::merge($settings, $region);
        return $merge;
    }

    public function getAll() {

        $settings = $this->find('all');
        $pretty = array();
        if (empty($settings)) {

            return $pretty;
        }

        foreach ($settings as $v) {

            $key = strtolower($v[$this->alias]['key']);
            $value = $v[$this->alias]['value'];

            // nếu giá trị trong value là kiểu số thì ép kiểu về kiểu số
            if (is_numeric($value)) {

                $value = (int) $value;
            }
            // nếu giá trị trong value là 1 chuỗi json thì biến nó thành kiểu mảng
            elseif (UtilityCommon::isJson($value)) {

                $value = json_decode($value, true);
            }

            $pretty[$key] = $value;
        }

        return $pretty;
    }

}
