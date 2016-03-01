<?php

App::uses('ServiceAppController', 'Controller');

class FeedbackServicesController extends ServiceAppController {

    public $uses = array(
        'Feedback',
        'Customer',
    );
    public $debug_mode = 3;

    public function create() {

        $this->log_file_name = __CLASS__ . '_' . __FUNCTION__;
        $this->setInit();

        if (
                !isset($this->request->data['name']) ||
                !isset($this->request->data['description'])
        ) {

            $this->resError('#fee001');
        }

        $name = trim($this->request->data['name']);
        $description = trim($this->request->data['description']);

        if (
                !strlen($name) ||
                !strlen($description)
        ) {

            $this->resError('#fee001');
        }

        $customer_code = $this->request->data('customer_code');
        $customer_name = $this->request->data('customer_name');
        $customer_mobile = $this->request->data('customer_mobile');
        $customer_mobile2 = $this->request->data('customer_mobile2');

        $customer = $this->Customer->findByCode($customer_code);
        $customer_id = !empty($customer['Customer']['id']) ? $customer['Customer']['id'] : '';


        $save_data = array(
            'name' => $name,
            'description' => $description,
            'customer_id' => $customer_id,
            'customer_code' => $customer_code,
            'customer_name' => $customer_name,
            'customer_mobile' => $customer_mobile,
            'customer_mobile2' => $customer_mobile2,
            'platform_os' => $this->request->data('platform_os'),
            'platform_version' => $this->request->data('platform_version'),
            'client_ip' => $this->request->clientIp(),
            'user_agent' => $this->request->header('User-Agent'),
            'host' => $this->request->host(),
        );

        $this->{$this->modelClass}->create();
        if ($this->{$this->modelClass}->save($save_data)) {

            $res = array(
                'data' => array(
                    'id' => $this->{$this->modelClass}->getLastInsertID(),
                ),
            );
            $this->resSuccess($res);
        } else {

            $this->resError('#fee002', array(
                'data' => array(
                    'validationErrors' => $this->{$this->modelClass}->validationErrors,
                ),
            ));
        }
    }

}
