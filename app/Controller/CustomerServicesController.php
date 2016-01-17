<?php

App::uses('ServiceAppController', 'Controller');

class CustomerServicesController extends ServiceAppController {

    public $uses = array(
        'Customer',
    );
    public $debug_mode = 3;

    public function detail($code = null) {

        $this->log_file_name = __CLASS__ . '_' . __FUNCTION__;
        $this->setInit();

        if (empty($code)) {

            $this->resError('#cus001');
        }

        $customer = $this->Customer->findByCode($code);
        if (empty($customer)) {

            $this->resError('#cus002', array(
                'message_args' => array(
                    $code
                ),
            ));
        }

        $res = array(
            'data' => array(
                'id' => $customer['Customer']['id'],
                'code' => $customer['Customer']['code'],
                'name' => $customer['Customer']['name'],
                'mobile' => $customer['Customer']['mobile'],
                'mobile2' => $customer['Customer']['mobile2'],
                'email' => $customer['Customer']['email'],
                'address' => $customer['Customer']['address'],
                'total_order' => $customer['Customer']['total_order'],
                'total_order_success' => $customer['Customer']['total_order_success'],
                'total_order_pending' => $customer['Customer']['total_order_pending'],
                'total_order_fail' => $customer['Customer']['total_order_fail'],
                'total_order_bad' => $customer['Customer']['total_order_bad'],
                'total_order_bundle' => $customer['Customer']['total_order_bundle'],
                'total_order_bundle_success' => $customer['Customer']['total_order_bundle_success'],
                'total_order_bundle_pending' => $customer['Customer']['total_order_bundle_pending'],
                'total_order_bundle_fail' => $customer['Customer']['total_order_bundle_fail'],
                'total_order_bundle_bad' => $customer['Customer']['total_order_bundle_bad'],
            ),
        );

        $this->resSuccess($res);
    }

}
