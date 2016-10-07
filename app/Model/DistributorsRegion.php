<?php

class DistributorsRegion extends AppModel {

    public $useTable = 'distributors_regions';

    public function getRegionId($distributor_id) {
        $result = $this->find('all', array(
            'recursive' => -1,
            'conditions' => array(
                'distributor_id' => $distributor_id,
            ),
        ));
        if (empty($result)) {
            return array();
        }
        App::uses('Region', 'Model');
        $Region = new Region();
        $Region->Behaviors->unload('ManagerFilter');
        $region_ids = array();
        foreach ($result as $v) {
            $region_id = $v[$this->alias]['region_id'];
            $region_ids[$region_id] = $region_id;
            $region = $Region->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'id' => $region_id,
                ),
            ));
            if (empty($region) || empty($region[$Region->alias]['parent_id'])) {
                continue;
            }
            $region_ids[$region[$Region->alias]['parent_id']] = $region[$Region->alias]['parent_id'];
        }
        $Region->Behaviors->load('ManagerFilter');
        return array_values($region_ids);
    }

}
