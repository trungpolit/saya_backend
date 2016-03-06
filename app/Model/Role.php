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

    public function findByPublicId($id) {

        return $this->find('first', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'id' => $id,
                        'status' => STATUS_PUBLIC,
                    ),
        ));
    }

    public function getPerms($id) {

        App::uses('RolesPerm', 'Model');
        $RolesPerm = new RolesPerm();

        $roles_perms = $RolesPerm->find('list', array(
            'recursive' => -1,
            'conditions' => array(
                'role_id' => $id,
            ),
            'fields' => array(
                'id', 'perm_id',
            ),
        ));
        if (empty($roles_perms)) {

            return array();
        }

        App::uses('Perm', 'Model');
        $Perm = new Perm();
        $perms = $Perm->find('list', array(
            'recursive' => -1,
            'conditions' => array(
                'id' => $roles_perms,
            ),
            'fields' => array(
                'id', 'code',
            ),
        ));
        return $perms;
    }

}
