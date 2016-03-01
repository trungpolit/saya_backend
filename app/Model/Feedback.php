<?php

class Feedback extends AppModel {

    public $useTable = 'feedbacks';
    public $validate = array(
        'name' => array(
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => 'Giới hạn tối đa 255 kí tự',
            ),
        ),
        'description' => array(
            'maxLength' => array(
                'rule' => array('maxLength', 5000),
                'message' => 'Giới hạn tối đa 5000 kí tự',
            ),
        ),
    );

}
