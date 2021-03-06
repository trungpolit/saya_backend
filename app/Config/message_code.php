<?php

$config['message_code'] = array(
    'OrderServices' => array(
        '#ord001' => 'The order param is empty.',
        '#ord002' => 'The order param is invalid json string.',
        '#ord003' => 'The customer was banned.',
        '#ord004' => 'The cart data is empty.',
        '#ord005' => 'The order was not create successfully.',
        '#ord006' => 'The order bundle was not create successfully.',
        '#ord007' => 'The order product was not create successfully.',
        '#ord008' => 'Update customer data was failed.',
    ),
    'CustomerServices' => array(
        '#cus001' => 'The code param is empty.',
        '#cus002' => 'The customer with code=%s does not exist.',
    ),
    'FeedbackServices' => array(
        '#fee001' => 'The name or description param is empty.',
        '#fee002' => 'The feedback can not save successful.',
    ),
    'DeviceServices' => array(
        '#des001' => 'The platform or token param is empty.',
        '#des002' => 'The device can not save successful.',
    ),
);
