<?php

class DailyReport extends AppModel {

    public $actsAs = array('ManagerFilter');

    public function checkExist($date, $region_id, $bundle_id) {

        return $this->find('first', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'date' => $date,
                        'region_id' => $region_id,
                        'bundle_id' => $bundle_id,
                    ),
        ));
    }

}
