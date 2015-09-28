<?php

class Perm extends AppModel {

    public $useTable = 'perms';

    public function getInfoByCode($code) {

        return $this->find('first', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'code' => $code,
                    ),
        ));
    }

}
