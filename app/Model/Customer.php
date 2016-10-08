<?php

App::uses('CacheCommon', 'Lib');

class Customer extends AppModel {

    public $useTable = 'customers';
    public $cached = 1;

    public function getInfoByCode($code) {

        return $this->find('first', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'code' => $code,
                    ),
        ));
    }

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);

        if ($this->cached) {
            // đọc lại thông tin customer để cache
            $customer = $this->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'id' => $this->id,
                ),
            ));

            $customer_code = $customer[$this->alias]['code'];
            $cache_path = APP . Configure::read('saya.App.cache_path') . $this->useTable . '/' . $customer_code . '.json';

            $json_content = json_encode($customer[$this->alias]);
            return CacheCommon::write($cache_path, $json_content);
        }

//        // nếu thưc hiện tạo mới customer thì cộng +1 vào report_dailys.total_customer
//        // công +1 vào report_dailys.total_customer_good
//        if (
//                $created &&
//                isset($this->data[$this->alias]['region_id']) &&
//                isset($this->data[$this->alias]['bundle_id'])
//        ) {
//
//            App::uses('ReportDaily', 'Model');
//            $ReportDaily = new ReportDaily();
//            $region_id = $this->data[$this->alias]['region_id'];
//            $bundle_id = $this->data[$this->alias]['bundle_id'];
//            $date = date('Ymd');
//            $save_data = array();
//
//            $report_daily = $ReportDaily->checkExist($date, $region_id, $bundle_id);
//            if (empty($report_daily)) {
//
//                $ReportDaily->create();
//                $save_data['date'] = $date;
//                $save_data['region_id'] = $region_id;
//                $save_data['bundle_id'] = $bundle_id;
//                $save_data['total_customer'] = 1;
//                $save_data['total_customer_good'] = 1;
//                $ReportDaily->save($save_data);
//            } else {
//
//                $ReportDaily->updateAll(array(
//                    $ReportDaily->alias . '.' . 'total_customer' => $ReportDaily->alias . '.' . 'total_customer' . '+1',
//                    $ReportDaily->alias . '.' . 'total_customer_good' => $ReportDaily->alias . '.' . 'total_customer_good' . '+1',
//                        ), array(
//                    $ReportDaily->alias . '.' . 'id' => $report_daily[$ReportDaily->alias]['id'],
//                ));
//            }
//        } elseif (!$created) {
//            
//        }
    }

    public function cache() {

        $this->cached = 1;
        $customers = $this->find('all', array(
            'recursive' => -1,
        ));

        if (empty($customers)) {
            return;
        }

        foreach ($customers as $cust) {
            $this->save(array(
                'id' => $cust[$this->alias]['id'],
            ));
        }
    }

}
