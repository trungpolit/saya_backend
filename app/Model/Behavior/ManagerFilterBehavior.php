<?php

class ManagerFilterBehavior extends ModelBehavior {

    public function beforeFind(\Model $model, $query) {
        parent::beforeFind($model, $query);

        $user = CakeSession::read('Auth.User');
        if ($user['type'] != MANAGER_TYPE) {

            return true;
        }
        $region_id = $user['region_id'];
        $bundle_id = $user['bundle_id'];

        if ($model->alias == 'Region') {

            // thực hiện tìm kiếm parent_id
            $regions = $model->find('all', array(
                'callbacks' => false,
                'recursive' => -1,
                'conditions' => array(
                    'id' => $region_id,
                ),
            ));
            $region_parent_id = Hash::extract($regions, '{n}.' . $model->alias . '.parent_id');
            $query['conditions'][$model->alias . '.id'] = array_merge($region_id, $region_parent_id);
        }
        if ($model->alias == 'Bundle') {

            $query['conditions'][$model->alias . '.id'] = $bundle_id;
        }
        if ($model->alias == 'OrdersBundle') {

            $query['conditions'][$model->alias . '.bundle_id'] = $bundle_id;
            $query['conditions'][$model->alias . '.region_id'] = $region_id;
        }
        if ($model->alias == 'DailyReport') {

            $query['conditions'][$model->alias . '.bundle_id'] = $bundle_id;
            $query['conditions'][$model->alias . '.region_id'] = $region_id;
        }
        if ($model->alias == 'Product') {

            $query['conditions'][$model->alias . '.bundle_id'] = $bundle_id;
            $query['conditions'][$model->alias . '.region_id'] = $region_id;
        }

        return $query;
    }

}
