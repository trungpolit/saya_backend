<?php

class Notification extends AppModel {

    public $useTable = 'notifications';
    public $cached = 1;

    public function beforeSave($options = array()) {
        parent::beforeSave($options);

        if ($this->cached && !empty($this->data[$this->alias]['id'])) {

            $this->prev_data = $this->find('first', array(
                'conditions' => array(
                    'id' => $this->data[$this->alias]['id'],
                ),
                'recursive' => -1,
            ));
        }

        if (isset($this->data[$this->alias]['begin_at'])) {

            $this->data[$this->alias]['begin_at'] = date('Y-m-d H:i:s', strtotime($this->data[$this->alias]['begin_at']));
        }

        if (isset($this->data[$this->alias]['end_at'])) {

            $this->data[$this->alias]['end_at'] = date('Y-m-d H:i:s', strtotime($this->data[$this->alias]['end_at']));
        }

        if (isset($this->data[$this->alias]['name'])) {

            $this->data[$this->alias]['description'] = $this->data[$this->alias]['name'];
        }
    }

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);

        if ($this->cached) {

            $this->resetCache();
        }
    }

    public function cache() {

        App::uses('CacheCommon', 'Lib');
        $cache_path = APP . Configure::read('saya.Notification.cache_path');

        $notifications = $this->find('all', array(
            'recursive' => -1,
            'conditions' => array(
                'status' => 2,
            ),
        ));

        $region_ids = array();
        $periods = array();
        foreach ($notifications as $v) {

            if (empty($v[$this->alias]['region_id'])) {

                continue;
            }
            $region_ids[] = $v[$this->alias]['region_id'];
            $this->pushPeriods($periods, $v[$this->alias]['region_id'], $v[$this->alias]['begin_at'], $v[$this->alias]['end_at']);
        }

        $this->resetCacheByRegion($region_ids, $periods, $cache_path);
    }

    public function getByRegionYearMonth($region_id, $ym) {

        return $this->find('all', array(
                    'conditions' => array(
                        'region_id' => $region_id,
                        'status' => 2,
                        'DATE_FORMAT(begin_at,"%Y%m") <=' => $ym,
                        'DATE_FORMAT(end_at,"%Y%m") >=' => $ym,
                    ),
                    'recursive' => -1,
        ));
    }

    protected function resetCache() {

        App::uses('CacheCommon', 'Lib');
        $cache_path = APP . Configure::read('saya.Notification.cache_path');

        $region_ids = array();
        $periods = array();
        if (!empty($this->prev_data) && !empty($this->data[$this->alias]['region_id'])) {

            $prev_region_id = $this->prev_data[$this->alias]['region_id'];
            $region_id = $this->data[$this->alias]['region_id'];
            $region_ids[$prev_region_id] = $prev_region_id;
            $region_ids[$region_id] = $region_id;

            $this->pushPeriods($periods, $prev_region_id, $this->prev_data[$this->alias]['begin_at'], $this->prev_data[$this->alias]['end_at']);
            $this->pushPeriods($periods, $region_id, $this->data[$this->alias]['begin_at'], $this->data[$this->alias]['end_at']);

            $this->resetCacheByRegion($region_ids, $periods, $cache_path);
        } elseif (!empty($this->data[$this->alias]['region_id'])) {

            $region_id = $this->data[$this->alias]['region_id'];
            $region_ids[$region_id] = $region_id;

            $this->pushPeriods($periods, $region_id, $this->data[$this->alias]['begin_at'], $this->data[$this->alias]['end_at']);

            $this->resetCacheByRegion($region_ids, $periods, $cache_path);
        }
    }

    protected function pushPeriods(&$periods, $region_id, $begin_at, $end_at) {

        $periods = array();
        if (empty($periods[$region_id])) {

            $periods[$region_id] = array(
                array(
                    'begin_at' => $begin_at,
                    'end_at' => $end_at,
                ),
            );
        } else {

            $periods[$region_id][] = array(
                'begin_at' => $begin_at,
                'end_at' => $end_at,
            );
        }

        // thực hiện lọc trùng lặp
        if (count($periods[$region_id]) > 1) {

            if (
                    date('Ym', strtotime($periods[$region_id][0]['begin_at'])) == date('Ym', strtotime($periods[$region_id][1]['begin_at'])) &&
                    date('Ym', strtotime($periods[$region_id][0]['end_at'])) == date('Ym', strtotime($periods[$region_id][1]['end_at']))
            ) {

                unset($periods[$region_id][1]);
            }
        }

        return $periods;
    }

    protected function extractYearMonths($period) {

        $months = array();

        foreach ($period as $v) {

            $begin_at = $v['begin_at'];
            $end_at = $v['end_at'];

            if (strtotime($begin_at) > strtotime($end_at)) {

                return array();
            }

            $start = strtotime($begin_at);
            $end = strtotime($end_at);

            $start_month = date('Ym', $start);
            $end_month = date('Ym', $end);
            while ($start_month <= $end_month) {

                $months[] = date('Ym', $start);
                $start = strtotime("+1 month", $start);
                $start_month = date('Ym', $start);
            }
        }

        return $months;
    }

    protected function resetCacheByRegion($region_ids, $periods, $cache_path) {

        foreach ($region_ids as $v) {

            if (empty($periods[$v])) {

                continue;
            }
            $period = $periods[$v];
            $year_months = $this->extractYearMonths($period);
            if (empty($year_months)) {

                continue;
            }

            foreach ($year_months as $ym) {

                $raw = $this->getByRegionYearMonth($v, $ym);
                $notifications = Hash::extract($raw, '{n}.' . $this->alias);
                $cache_file = $cache_path . $v . '_' . $ym . '.json';

                CacheCommon::write($cache_file, json_encode($notifications));
            }
        }
    }

}
