<?php

class Device extends AppModel {

    public $useTable = 'devices';

    public function findByPlatformToken($platform, $token) {
        return $this->find('first', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'platform' => $platform,
                        'token' => $token,
                    ),
        ));
    }

}
