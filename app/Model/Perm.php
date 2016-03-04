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

    public function getList($options = array()) {

        $default_opts = array(
            'fields' => array(
                'id', 'name',
            ),
            'order' => array(
                'weight' => 'ASC',
                'modified' => 'DESC',
            ),
            'recursive' => -1,
        );
        $options = Hash::merge($default_opts, $options);
        return $this->find('list', $options);
    }

}
