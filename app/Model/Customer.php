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
