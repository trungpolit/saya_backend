<?php

class CrontabQueue extends AppModel {

    public $useTable = 'crontab_queues';

    public function checkExists($date, $name) {

        return $this->find('first', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'date' => $date,
                        'name' => $name,
                    ),
        ));
    }

}
