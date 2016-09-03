<?php

App::uses('ServiceAppController', 'Controller');

class DeviceServicesController extends ServiceAppController {

    public $uses = array('Device');
    public $debug_mode = 3;

    public function reg() {
        $this->log_file_name = __CLASS__ . '_' . __FUNCTION__;
        $this->setInit();

        $platform = $this->request->query('platform');
        $token = $this->request->query('token');
        if (empty($platform) || empty($token)) {
            $this->resError('#des001');
        }
        $host = $this->request->host();
        $host_ip = getHostByName($host);
        $save_data = array(
            'platform' => $platform,
            'token' => $token,
            'host' => $host,
            'host_ip' => $host_ip,
            'client_ip' => $this->request->clientIp(),
            'user_agent' => $this->request->header('User-Agent'),
        );
        $device = $this->Device->findByPlatformToken($platform, $token);
        if (empty($device)) {
            $this->Device->create();
        } else {
            $save_data['id'] = $device['Device']['id'];
        }
        if ($this->Device->save($save_data)) {
            $device_id = $this->Device->id;
            $res = array(
                'data' => array(
                    'device_id' => $device_id,
                )
            );
            $this->resSuccess($res);
        } else {
            $this->resError('#des002');
        }
    }

}
