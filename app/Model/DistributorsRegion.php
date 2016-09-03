<?php

class DistributorsRegion extends AppModel {

    public $useTable = 'distributors_regions';

    public function getRegionId($user_id) {

        return $this->find('list', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'user_id' => $user_id,
                    ),
                    'fields' => array(
                        'id', 'region_id',
                    ),
        ));
    }

}
