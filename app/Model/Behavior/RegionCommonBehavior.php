<?php

App::uses('Region', 'Model');

class RegionCommonBehavior extends ModelBehavior {

    public function afterFind(\Model $model, $results, $primary = false) {
        parent::afterFind($model, $results, $primary);

        if (empty($results)) {

            return $results;
        }

        $region_parent_ids = array();
        $Region = new Region();
        foreach ($results as $k => $v) {

            if (empty($v[$model->alias]['region_id'])) {

                continue;
            }

            if (empty($region_parent_ids[$v[$model->alias]['region_id']])) {

                $get_region = $Region->find('first', array(
                    'conditions' => array(
                        'id' => $v[$model->alias]['region_id'],
                    ),
                    'recursive' => -1,
                ));
                $region_parent_ids[$v[$model->alias]['region_id']] = !empty($get_region) ?
                        $get_region['Region']['parent_id'] : '';
            }

            $results[$k][$model->alias]['region_parent_id'] = $region_parent_ids[$v[$model->alias]['region_id']];
        }

        return $results;
    }

}
