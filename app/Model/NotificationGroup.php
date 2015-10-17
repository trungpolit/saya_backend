<?php

class NotificationGroup extends AppModel {

    public $useTable = 'notification_groups';

    public function getInfoByRegionId($region_id) {

        return $this->find('first', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'region_id' => $region_id,
                    ),
        ));
    }

    public function syncDetele($region_id) {

        $notification_group = $this->getInfoByRegionId($region_id);
        if (empty($notification_group)) {

            return true;
        }

        return $this->delete($notification_group[$this->alias]['id'], false);
    }

}
