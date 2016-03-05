<?php

class User extends AppModel {

    public $useTable = 'users';

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);

        if (isset($this->data[$this->alias]['bundle_id'])) {

            App::uses('UsersBundle', 'Model');
            $UsersBundle = new UsersBundle();
            $UsersBundle->deleteAll(array(
                $UsersBundle->alias . '.user_id' => $this->id,
                    ), false);

            $save_data = array();
            foreach ($this->data[$this->alias]['bundle_id'] as $v) {

                $save_data[] = array(
                    'user_id' => $this->id,
                    'bundle_id' => $v,
                );
            }
            $UsersBundle->saveAll($save_data);
        }

        if (isset($this->data[$this->alias]['region_id'])) {

            App::uses('UsersRegion', 'Model');
            $UsersRegion = new UsersRegion();
            $UsersRegion->deleteAll(array(
                $UsersRegion->alias . '.user_id' => $this->id,
                    ), false);

            $save_data = array();
            foreach ($this->data[$this->alias]['region_id'] as $v) {

                $save_data[] = array(
                    'user_id' => $this->id,
                    'region_id' => $v,
                );
            }
            $UsersRegion->saveAll($save_data);
        }
    }

}
