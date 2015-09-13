<?php

class FileManaged extends AppModel {

    public $useTable = 'file_managed';

    public function beforeSave($options = array()) {
        parent::beforeSave($options);

        if (DIRECTORY_SEPARATOR == '\\' && !empty($this->data[$this->alias]['uri'])) {

            $this->data[$this->alias]['uri'] = str_replace('\\', '/', $this->data[$this->alias]['uri']);
        }

        if (!empty($this->data[$this->alias]['uri'])) {

            $this->data[$this->alias]['uri'] = ltrim($this->data[$this->alias]['uri'], '/');
        }
    }

}
