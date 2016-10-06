<?php

App::uses('FileMapping', 'Model');
App::uses('FileManaged', 'Model');
App::uses('UtilityCommon', 'Lib');

class FileCommonBehavior extends ModelBehavior {

    public function afterSave(\Model $model, $created, $options = array()) {
        parent::afterSave($model, $created, $options);
        if (empty($model->file_fields)) {
            return true;
        }
        $FileMapping = new FileMapping();
        $FileManaged = new FileManaged();
        $cache_data = array(
            'id' => $model->id,
        );

        foreach ($model->file_fields as $field) {
            if (!isset($model->data[$model->alias][$field])) {
                continue;
            }
            $FileMapping->deleteAll(array(
                'FileMapping.row_id' => $model->id,
                'FileMapping.table_name' => $model->useTable,
                'type' => $field,
            ));
            if (empty($model->data[$model->alias][$field])) {
                continue;
            }

            $file_data = array();
            if (!is_array($model->data[$model->alias][$field])) {
                $file_data[] = $model->data[$model->alias][$field];
            } else {
                $file_data = $model->data[$model->alias][$field];
            }

            $module_name = Configure::read('saya.' . $model->alias . '.module_name');
            $target_file_data = UtilityCommon::moveFromTmp($file_data, $module_name);
            $this->saveFileMapping($target_file_data, $FileMapping, $model, $field);
            $this->saveFileCache($cache_data, $target_file_data, $FileManaged, $field);
        }

        $model->data = $model->save($cache_data, array(
            'callbacks' => false,
        ));

        return true;
    }

    protected function saveFileCache(&$cache_data, $file_data, $FileManaged, $field) {
        $cache_field = $field . '_uri';
        if (empty($file_data)) {
            $cache_data[$cache_field] = '';
            return true;
        }

        $file_uris = array();
        foreach ($file_data as $item) {
            $file_managed_id = $item['id'];
            $file_managed = $FileManaged->find('first', array(
                'conditions' => array(
                    'id' => $file_managed_id,
                ),
            ));
            if (empty($file_managed)) {
                continue;
            }
            $file_uris[] = $file_managed['FileManaged']['uri'];
        }
        $cache_data[$cache_field] = serialize($file_uris);
    }

    protected function saveFileMapping($file_data, $FileMapping, $model, $field) {
        if (empty($file_data)) {
            return true;
        }

        $save_data = array();
        foreach ($file_data as $item) {
            $save_data[] = array(
                'file_managed_id' => $item['id'],
                'table_name' => $model->useTable,
                'row_id' => $model->id,
                'type' => $field,
                'count' => 1,
            );
        }

        $FileMapping->create();
        return $FileMapping->saveAll($save_data);
    }

    public function afterFind(\Model $model, $results, $primary = false) {
        parent::afterFind($model, $results, $primary);

        if (empty($results) || empty($model->file_proccess) || empty($model->file_fields)) {
            return $results;
        }

        $FileMapping = new FileMapping();
        $FileManaged = new FileManaged();
        foreach ($results as $key => $item) {
            foreach ($model->file_fields as $field) {
                $file_mapping = $FileMapping->find('list', array(
                    'conditions' => array(
                        'table_name' => $model->useTable,
                        'row_id' => $item[$model->alias]['id'],
                        'type' => $field,
                    ),
                    'fields' => array(
                        'file_managed_id', 'file_managed_id',
                    ),
                ));
                if (empty($file_mapping)) {
                    continue;
                }

                $results[$key][$model->alias][$field] = $this->getFileManaged($file_mapping, $FileManaged);
            }
        }

        return $results;
    }

    protected function getFileManaged($file_mapping, $FileManaged) {
        $parser = array();
        foreach ($file_mapping as $file_managed_id) {
            $file_managed = $FileManaged->find('first', array(
                'conditions' => array(
                    'id' => $file_managed_id,
                ),
            ));
            if (empty($file_managed)) {
                continue;
            }
            $parser[] = json_encode($file_managed['FileManaged']);
        }

        return $parser;
    }

}
