<?php

class UsersBundle extends AppModel {

    public $useTable = 'users_bundles';

    public function getBundleId($user_id) {

        return $this->find('list', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'user_id' => $user_id,
                    ),
                    'fields' => array(
                        'id', 'bundle_id',
                    ),
        ));
    }

}
