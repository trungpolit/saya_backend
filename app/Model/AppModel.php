<?php

/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    public function getList($options = array()) {

        $default_opts = array(
            'conditions' => array(
                'status' => STATUS_PUBLIC,
            ),
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

    public function getPublic($options = array()) {

        $default_opts = array(
            'conditions' => array(
                'status' => STATUS_PUBLIC,
            ),
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
        return $this->find('all', $options);
    }

    /**
     * incrementField
     * Thực hiện tăng giá trị cho trường Field lên +$inc 
     * 
     * @param int $id
     * @param string or array $field_name
     * @param int $inc
     * 
     * @return mixed
     */
    function incrementField($id, $field_name, $inc = 1) {

        if (!is_array($field_name)) {

            $field_name = array($field_name);
        }
        $save_data = array();
        foreach ($field_name as $k => $v) {

            $save_data[$k][$this->alias . '.' . $v] = $this->alias . '.' . $v . '+' . $inc;
        }

        return $this->updateAll($save_data, array($this->alias . '.id' => $id));
    }

}
