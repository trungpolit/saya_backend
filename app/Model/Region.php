<?php

App::uses('NotificationGroup', 'Model');

class Region extends AppModel {

    public $useTable = 'regions';
    public $cached = 0;
    public $actsAs = array('Tree', 'ManagerFilter');

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);

        if ($this->cached) {

            $this->cache();
        }

        // đồng bộ với nhóm thông báo NotificationGroup
//        $this->syncNotificationGroup($this->id);
    }

//    public function afterDelete() {
//        parent::afterDelete();
//
//        $NotificationGroup = new NotificationGroup();
//        $NotificationGroup->syncDetele($this->id);
//    }

    protected function syncNotificationGroup($region_id) {

        $NotificationGroup = new NotificationGroup();
        $notification_group = $NotificationGroup->getInfoByRegionId($region_id);

        $region = $this->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'id' => $region_id,
            ),
        ));

        $save_data = array(
            'name' => $region[$this->alias]['name'],
            'status' => $region[$this->alias]['status'],
            'region_id' => $region_id,
        );
        if (empty($notification_group)) {

            $save_data['description'] = $region[$this->alias]['description'];
            $NotificationGroup->create();
        } else {

            $save_data['id'] = $notification_group[$NotificationGroup->alias]['id'];
        }

        $NotificationGroup->save($save_data);
    }

    public function cache() {

        App::uses('CacheCommon', 'Lib');
        $cache_path = APP . Configure::read('saya.App.cache_path') . $this->useTable . '.json';
        $parents = $this->getListParents();
        $children = $this->getListChildren();

        // thực hiện hợp nhất vào setting cache
//        $this->mergeSettingCache($parents, $children);
        $this->updateSettingCache();

        $json_content = json_encode(array(
            'parent' => $parents,
            'child' => $children,
        ));

        return CacheCommon::write($cache_path, $json_content);
    }

    /**
     * mergeSettingCache
     * thực hiện hợp nhất với setting cache
     * 
     * @param array $parents - mảng chứa region tỉnh/thành phố
     * @param array $children - mảng chứa region quận/huyện/thị xã
     */
    protected function mergeSettingCache($parents, $children) {

        App::uses('Setting', 'Model');
        $Setting = new Setting();

        $settings = $Setting->getAll();
        $cache_path = APP . Configure::read('saya.App.cache_path') . $Setting->useTable . '.json';

        $content = array(
            $this->useTable => array(
                'parent' => $parents,
                'child' => $children,
            ),
        );
        $content = Hash::merge($content, $settings);
        $json_content = json_encode($content);

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
                    'order' => array(
                        'weight' => 'ASC',
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
                    'order' => array(
                        'weight' => 'ASC',
                    ),
        ));
    }

    public function generateNotificationGroup() {

        $regions = $this->find('all');
        if (empty($regions)) {

            return;
        }

        foreach ($regions as $v) {

            $region_id = $v[$this->alias]['id'];
            $this->syncNotificationGroup($region_id);
        }
    }

    public function getTree() {

        // lấy ra các region_parents
        $parent = $this->getListParents();
        $child = $this->getListChildren();

        $trees = array();
        foreach ($child as $k => $v) {

            $trees[$parent[$k]] = array();
            foreach ($v as $kk => $vv) {

                $trees[$parent[$k]][$kk] = $vv;
            }
        }
        return $trees;
    }

    public function getChildrenFromTree($trees) {

        if (empty($trees)) {

            return array();
        }

        $children = array();
        foreach ($trees as $k => $v) {

            foreach ($v as $kk => $vv) {

                $children[$kk] = $vv;
            }
        }
        return $children;
    }

}
