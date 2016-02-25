<?php

/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
//App::uses('AppHelper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class CommonHelper extends AppHelper {

    public function parseDateTime($datetime) {

        if (empty($datetime)) {

            return '';
        }

        return date('d-m-Y H:i:s', strtotime($datetime));
    }

    public function getOrderClass($status) {

        switch ($status) {
            case STATUS_PENDING:
                return '';
            case STATUS_SUCCESS:
                return 'success';
            case STATUS_FAIL:
                return 'warning';
            case STATUS_BAD:
                return 'danger';
            default :
                return '';
        }
    }

    public function parseDate($date) {

        if (empty($date)) {

            return '';
        }

        return date('d-m-Y', strtotime($date));
    }

}
