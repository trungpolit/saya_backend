<?php

class User extends AppModel {

    public $useTable = 'users';
    public $validate = array(
        'username' => array(
            'alphaNumeric' => array(
                'rule' => '/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/',
                'message' => 'Tên tài khoản chỉ bao gồm chữ hoặc số',
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Tên tài khoản đã tồn tại',
            ),
        ),
    );

    public function beforeValidate($options = array()) {
        parent::beforeValidate($options);

        // thực hiện validate với trường hợp user là MANAGER
        if (
                isset($this->data[$this->alias]['type']) &&
                $this->data[$this->alias]['type'] == MANAGER_TYPE &&
                isset($this->data[$this->alias]['region_id']) &&
                isset($this->data[$this->alias]['bundle_id'])
        ) {

            $options = array(
                'recursive' => -1,
                'conditions' => array(
                    'UsersRegion.region_id' => $this->data[$this->alias]['region_id'],
                    'UsersBundle.bundle_id' => $this->data[$this->alias]['bundle_id'],
                ),
            );
            $options['joins'] = array(
                array(
                    'table' => 'users_regions',
                    'alias' => 'UsersRegion',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'User.id = UsersRegion.user_id',
                    )
                ),
                array(
                    'table' => 'users_bundles',
                    'alias' => 'UsersBundle',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'User.id = UsersBundle.user_id',
                    )
                ),
            );
            $user = $this->find('first', $options);
            if (!empty($user)) {

                $this->validationErrors['region_id'] = __('Tài khoản đã tồn tại tương ứng với Vùng miền và Nhóm sản phẩm');
                $this->validationErrors['bundle_id'] = __('Tài khoản đã tồn tại tương ứng với Vùng miền và Nhóm sản phẩm');

                return false;
            }
        }

        return true;
    }

    public function beforeSave($options = array()) {
        parent::beforeSave($options);

        if (!empty($this->data[$this->alias]['password'])) {

            $this->data[$this->alias]['password_show'] = $this->data[$this->alias]['password'];
            $this->data[$this->alias]['password'] = Security::hash(trim($this->data[$this->alias]['password']), null, true);
        }
    }

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

    public function listCode() {

        $users = $this->find('all', array(
            'recursive' => -1,
            'conditions' => array(
                'code !=' => '',
            ),
            'order' => array(
                'code' => 'ASC',
            ),
        ));
        if (empty($users)) {
            return $users;
        }
        App::uses('UsersBundle', 'Model');
        App::uses('UsersRegion', 'Model');
        $UsersBundle = new UsersBundle();
        $UsersRegion = new UsersRegion();
        $list = array();
        foreach ($users as $v) {
            $user_id = $v[$this->alias]['id'];
            $regions = $UsersRegion->find('list', array(
                'recursive' => -1,
                'conditions' => array(
                    'user_id' => $user_id,
                ),
                'fields' => array(
                    'region_id', 'region_id',
                ),
            ));
            $bundles = $UsersBundle->find('list', array(
                'recursive' => -1,
                'conditions' => array(
                    'user_id' => $user_id,
                ),
                'fields' => array(
                    'bundle_id', 'bundle_id',
                ),
            ));
            if (empty($regions) || empty($bundles)) {
                continue;
            }
            foreach ($regions as $r) {
                foreach ($bundles as $b) {
                    $list[$r . '_' . $b] = $v[$this->alias]['code'] . '|' . $v[$this->alias]['username'];
                }
            }
        }
        return $list;
    }

}
