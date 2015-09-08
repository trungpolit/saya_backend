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

        /**
         * Format date from MongoDate
         * @param MonggoDate $mongoDatetime
         * @return string
         */
        public function parseDate($mongoDatetime) {

                if ($mongoDatetime instanceof MongoDate) {

                        return date("d-m-Y", $mongoDatetime->sec);
                }

                return $mongoDatetime ? date("d-m-Y", strtotime($mongoDatetime)) : '';
        }

        /**
         * Format time from MongoDate
         * @param MongoDate $mongoDatetime
         * @return string
         */
        public function parseTime($mongoDatetime) {

                if ($mongoDatetime instanceof MongoDate) {

                        return date("H:i:s", $mongoDatetime->sec);
                }

                return $mongoDatetime ? date("H:i:s", strtotime($mongoDatetime)) : '';
        }

        /**
         * Format date from MongoDate
         * @param MonggoDate $mongoDatetime
         * @return string
         */
        public function parseDateTime($mongoDatetime) {

                if ($mongoDatetime instanceof MongoDate) {

                        return date("d-m-Y H:i:s", $mongoDatetime->sec);
                }

                return $mongoDatetime ? date("d-m-Y H:i:s", strtotime($mongoDatetime)) : '';
        }

        /**
         * Format time from MongoId
         * @param MongoId $mongoId
         * @return string
         */
        public function parseId($mongoId) {

                if ($mongoId instanceof MongoId) {

                        return (string) $mongoId;
                }

                return $mongoId;
        }

        /**
         * Get string location_id
         * @param array $data
         */
        public function getLocationId($data) {
                if (isset($data['location']['_id'])) {
                        return $data['location']['_id']->{'$id'};
                }
        }

        function formatSizeUnits($bytes) {

                if ($bytes >= 1073741824) {

                        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
                } elseif ($bytes >= 1048576) {

                        $bytes = number_format($bytes / 1048576, 2) . ' MB';
                } elseif ($bytes >= 1024) {

                        $bytes = number_format($bytes / 1024, 2) . ' KB';
                } elseif ($bytes > 1) {

                        $bytes = $bytes . ' bytes';
                } elseif ($bytes == 1) {

                        $bytes = $bytes . ' byte';
                } else {

                        $bytes = '0 bytes';
                }

                return $bytes;
        }

}
