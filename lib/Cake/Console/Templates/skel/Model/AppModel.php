<?php

/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
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

    protected function _writeCache($cache_path, $content) {

        App::uses('Folder', 'Utility');
        App::uses('File', 'Utility');

        if (DIRECTORY_SEPARATOR == '\\') {

            $cache_path = str_replace('\\', '/', $cache_path);
        }

        $file = new File($cache_path);
        return $file->write($content);
    }

}
