<?php

class Distributor extends AppModel {

    public $useTable = 'distributors';
    public $actsAs = array(
        'HABTMCommon',
    );
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
        'code' => array(
            'alphaNumeric' => array(
                'rule' => '/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/',
                'message' => 'Mã chỉ bao gồm chữ hoặc số',
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Mã đã tồn tại',
            ),
        ),
    );
    public $hasAndBelongsToMany = array(
        'Region' =>
        array(
            'className' => 'Region',
            'joinTable' => 'distributors_regions',
            'foreignKey' => 'distributor_id',
            'associationForeignKey' => 'region_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'with' => 'DistributorsRegion',
        )
    );

    public function beforeSave($options = array()) {
        parent::beforeSave($options);

        if (isset($this->data[$this->alias]['password_show'])) {
            $this->data[$this->alias]['password'] = Security::hash(trim($this->data[$this->alias]['password_show']), null, true);
        }
    }

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);

        App::uses('User', 'Model');
        $User = new User();
        $user = $User->findByIsDistributorLink(1);
        $save_data = array();
        $save_data['distributor_id'] = $this->id;
        $save_data['is_distributor_link'] = 1;
        $save_data['role_id'] = DISTRIBUTOR_ROLE_ID;
        $save_data['type'] = DISTRIBUTOR_TYPE;
        if (empty($user)) {
            $User->create();
        } else {
            $save_data['id'] = $user[$User->alias]['id'];
        }
        if (isset($this->data[$this->alias]['code'])) {
            $save_data['distributor_code'] = $this->data[$this->alias]['code'];
        }
        if (isset($this->data[$this->alias]['username'])) {
            $save_data['username'] = $this->data[$this->alias]['username'];
        }
        if (isset($this->data[$this->alias]['password_show'])) {
            $save_data['password'] = $this->data[$this->alias]['password_show'];
        }
        if (isset($this->data[$this->alias]['region_id'])) {
            $save_data['region_id'] = $this->data[$this->alias]['region_id'];
        }

        return $User->save($save_data);
    }

    public function beforeDelete($cascade = true) {
        parent::beforeDelete($cascade);

        $distributor_id = $this->id;
        App::uses('User', 'Model');
        $User = new User();
        $User->deleteAll(array(
            'distributor_id' => $distributor_id
                ), false);

        return true;
    }

}