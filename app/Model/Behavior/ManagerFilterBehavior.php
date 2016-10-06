<?php

class ManagerFilterBehavior extends ModelBehavior {

    public function beforeFind(\Model $model, $query) {
        parent::beforeFind($model, $query);

        $user = CakeSession::read('Auth.User');
        if (empty($user) || $user['type'] != DISTRIBUTOR_TYPE) {
            return true;
        }
        $distributor_id = $user['distributor_id'];
        if ($model->alias == 'OrdersDistributor') {
            $query['conditions'][$model->alias . '.distributor_id'] = $distributor_id;
        }
        if ($model->alias == 'DailyReport') {
            $query['conditions'][$model->alias . '.distributor_id'] = $distributor_id;
        }
        if ($model->alias == 'Product') {
            $query['conditions'][$model->alias . '.distributor_id'] = $distributor_id;
        }
        if ($model->alias == 'DailyProductReport') {
            $query['conditions'][$model->alias . '.distributor_id'] = $distributor_id;
        }
        $region_id = $user['region_id'];
        if ($model->alias == 'Region') {
            $query['conditions'][$model->alias . '.id'] = $region_id;
        }

        return $query;
    }

}
