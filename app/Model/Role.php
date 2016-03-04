<?php

class Role extends AppModel {

    public $useTable = 'roles';

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);

        if (isset($this->data[$this->alias]['perm_id'])) {

            App::uses('RolesPerm', 'Model');
            $RolesPerm = new RolesPerm();
            $RolesPerm->deleteAll(array(
                $RolesPerm->alias . '.role_id' => $this->id,
                    ), false);

            $save_data = array();
            foreach ($this->data[$this->alias]['perm_id'] as $v) {

                $save_data[] = array(
                    'role_id' => $this->id,
                    'perm_id' => $v,
                );
            }
            $RolesPerm->saveAll($save_data);
        }
    }

}
