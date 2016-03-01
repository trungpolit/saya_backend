<?php

class Ads extends AppModel {

    public $useTable = 'ads';
    public $cached = 1;

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);

        if ($this->cached) {

            $this->updateSettingCache();
        }
    }

    public function getAll() {

        $ads = $this->find('all', array(
            'recursive' => -1,
            'conditions' => array(
                'status' => STATUS_ENABLE,
            ),
        ));
        $pretty = Hash::extract($ads, '{n}.' . $this->alias);
        return $pretty;
    }

}
