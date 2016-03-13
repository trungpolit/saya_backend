<?php

class ClientVersion extends AppModel {

    public $useTable = 'client_versions';
    public $cached = 1;

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);

        if ($this->cached) {

            $this->updateSettingCache();
        }
    }

    public function afterDelete() {
        parent::afterDelete();

        if ($this->cached) {

            $this->updateSettingCache();
        }
    }

    public function getAll() {

        $client_versions = $this->find('all');
        $pretty = Hash::extract($client_versions, '{n}.' . $this->alias);
        return $pretty;
    }

}
