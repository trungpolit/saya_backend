<?php

class DailyProductReport extends AppModel {

    public $actsAs = array('ManagerFilter');

    public function checkExist($date, $region_id, $distributor_id, $product_id) {
        return $this->find('first', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'date' => $date,
                        'region_id' => $region_id,
                        'distributor_id' => $distributor_id,
                        'product_id' => $product_id,
                    ),
        ));
    }

}
