<?php

class HABTMCommonBehavior extends ModelBehavior {

    public function afterSave(\Model $model, $created, $options = array()) {
        parent::afterSave($model, $created, $options);

        if (empty($model->hasAndBelongsToMany)) {

            return true;
        }

        foreach ($model->hasAndBelongsToMany as $k => $v) {

            $join_model = $v['with'];
            $foreignKey = $v['foreignKey'];
            $associationForeignKey = $v['associationForeignKey'];

            App::uses($join_model, 'Model');
            $JoinModel = new $join_model();

            // thực hiện xóa dữ liệu liên kết
            $JoinModel->deleteAll(array(
                $join_model . '.' . $foreignKey => $model->id,
                    ), false);

            if (empty($model->data[$model->alias][$associationForeignKey])) {

                continue;
            }

            $save_data = array();
            foreach ($model->data[$model->alias][$associationForeignKey] as $kk => $vv) {

                $save_data[$kk] = array(
                    $foreignKey => $model->id,
                    $associationForeignKey => $vv,
                );
            }
            $JoinModel->saveAll($save_data);
        }

        return true;
    }

    public function afterFind(\Model $model, $results, $primary = false) {
        parent::afterFind($model, $results, $primary);

        if (empty($results) || empty($model->hasAndBelongsToMany)) {

            return $results;
        }

        foreach ($model->hasAndBelongsToMany as $k => $v) {

            $join_model = $v['with'];
            $foreignKey = $v['foreignKey'];
            $associationForeignKey = $v['associationForeignKey'];

            App::uses($join_model, 'Model');
            $JoinModel = new $join_model();

            foreach ($results as $kk => $vv) {

                $id = $vv[$model->alias]['id'];
                $associationId = $JoinModel->find('list', array(
                    'conditions' => array(
                        $foreignKey => $id
                    ),
                    'recursive' => -1,
                    'fields' => array(
                        $associationForeignKey, $associationForeignKey
                    ),
                ));
                $results[$kk][$model->alias][$associationForeignKey] = array_values($associationId);
            }
        }

        return $results;
    }

}
