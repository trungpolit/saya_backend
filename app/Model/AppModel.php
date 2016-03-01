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
    public function incrementField($id, $field_name, $inc = 1) {

        if (!is_array($field_name)) {

            $field_name = array($field_name);
        }
        $save_data = array();
        foreach ($field_name as $k => $v) {

            $save_data[$k][$this->alias . '.' . $v] = $this->alias . '.' . $v . '+' . $inc;
        }

        return $this->updateAll($save_data, array($this->alias . '.id' => $id));
    }

    public function updateSettingCache() {

        App::uses('CacheCommon', 'Lib');
        App::uses('Setting', 'Model');
        App::uses('Region', 'Model');
        App::uses('ClientVersion', 'Model');
        App::uses('Ads', 'Model');

        $Setting = new Setting();
        $settings = $Setting->getAll();
        $cache_path = APP . Configure::read('saya.App.cache_path') . $Setting->useTable . '.json';

        // lấy ra danh sách Region
        $Region = new Region();
        $region_parents = $Region->getListParents();
        $region_children = $Region->getListChildren();
        $settings[$Region->useTable] = array(
            'parent' => $region_parents,
            'child' => $region_children,
        );

        // lấy ra danh sách ClientVersion
        $ClientVersion = new ClientVersion();
        $client_versions = $ClientVersion->getAll();
        $settings[$ClientVersion->useTable] = $client_versions;

        // lấy ra danh sách Ads
        $Ads = new Ads();
        $ads = $Ads->getAll();
        $settings[$Ads->useTable] = $ads;

        $json_content = json_encode($settings);
        return CacheCommon::write($cache_path, $json_content);
    }

}
