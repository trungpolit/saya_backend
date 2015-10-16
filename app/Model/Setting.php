<?php

class Setting extends AppModel {

    public $useTable = 'settings';
    public $cached = 0;

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);

        if ($this->cached) {

            $this->cache();
        }
    }

    public function cache() {

        App::uses('CacheCommon', 'Lib');
        $cache_path = APP . Configure::read('saya.App.cache_path') . $this->useTable . '.json';

        $settings = $this->getAll();
        $json_content = json_encode($settings);

        return CacheCommon::write($cache_path, $json_content);
    }

    public function getAll() {

        $settings = $this->find('all');
        $pretty = array();
        if (!empty($settings)) {

            foreach ($settings as $v) {

                $pretty[strtolower($v[$this->alias]['key'])] = $v[$this->alias]['value'];
            }
        }

        return $pretty;
    }

}
