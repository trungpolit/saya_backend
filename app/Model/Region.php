<?php

class Region extends AppModel {

    public $useTable = 'regions';
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
        $parents = $this->getListParents();
        $children = $this->getListChildren();

        $json_content = json_encode(array(
            'parent' => $parents,
            'child' => $children,
        ));

        return CacheCommon::write($cache_path, $json_content);
    }

    public function getListParents() {

        return $this->find('list', array(
                    'conditions' => array(
                        'status' => 2,
                        'parent_id' => null,
                    ),
                    'fields' => array(
                        'id', 'name',
                    ),
        ));
    }

    public function getListChildren() {

        return $this->find('list', array(
                    'conditions' => array(
                        'status' => 2,
                        'parent_id !=' => null,
                    ),
                    'fields' => array(
                        'id', 'name', 'parent_id',
                    ),
        ));
    }

}
