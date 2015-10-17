<?php

class Customer extends AppModel {

    public $useTable = 'customers';

    public function updateInfo($customer) {
        
    }

    public function getInfoByCode($code) {

        return $this->find('first', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'code' => $code,
                    ),
        ));
    }

}
