<?php

App::uses('CrontabAppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class CrontabOrdersDistributorsController extends CrontabAppController {

    public $uses = array(
        'OrdersDistributor',
        'Distributor',
        'Setting',
    );
    public $log_file_name = null;

    const LIMIT = 100;

    public function send() {
        $this->log_file_name = __CLASS__ . '_' . __FUNCTION__;
        $limit = $this->request->query('limit');
        if (empty($limit)) {
            $limit = self::LIMIT;
        }
        $date = $this->request->query('date');
        if (empty($date)) {
            $date = date('Y-m-d H:i:s');
        } else {
            $date = date('Y-m-d H:i:s', strtotime($date));
        }

        $settings = $this->Setting->find('list', array(
            'recursive' => -1,
            'conditions' => array(
                'key' => array(
                    'EMAIL_ADMIN',
                    'EMAIL_SUBJECT',
                    'EMAIL_LOGO',
                ),
            ),
            'fields' => array(
                'key', 'value',
            ),
        ));
        $email_admin = strlen($settings['EMAIL_ADMIN']) ? explode(',', $settings['EMAIL_ADMIN']) : array();
        $email_subject_pattern = $settings['EMAIL_SUBJECT'];

        $distributors = array();

        $this->logAnyFile(__('BEGIN: Thực hiện gửi email thông báo với date="%s"', $date), $this->log_file_name);
        $options = array(
            'recursive' => -1,
            'conditions' => array(
                'OR' => array(
                    array(
                        'sent_at' => null,
                    ),
                    array(
                        'sent_at >=' => date('Y-m-d', strtotime($date)) . ' 00:00:00',
                        'sent_at <' => date('Y-m-d', strtotime('+1 day', strtotime($date))) . ' 00:00:00',
                    ),
                ),
                'sent_status !=' => STATUS_SEND_SUCCESS,
            ),
            'limit' => $limit,
        );

        $count = 0;
        while (1) {
            $orders = $this->OrdersDistributor->find('all', $options);
            $count += count($orders);
            if (empty($orders)) {
                $this->logAnyFile(__('END: Kết thúc gửi email với date="%s", count="%s", limit="%s"', $date, $count, $limit), $this->log_file_name);
                exit();
            }
            foreach ($orders as $v) {
                $distributor_id = $v['OrdersDistributor']['distributor_id'];
                $distributor_email = array();
                $distributor_name = $distributor_code = null;
                if (!isset($distributors[$distributor_id])) {
                    $distributors[$distributor_id] = $this->Distributor->findById($distributor_id);
                    $distributor_email = !empty($distributors[$distributor_id]) ?
                            $distributors[$distributor_id]['Distributor']['email'] : array();
                    $distributor_name = !empty($distributors[$distributor_id]) ?
                            $distributors[$distributor_id]['Distributor']['name'] : null;
                    $distributor_code = !empty($distributors[$distributor_id]) ?
                            $distributors[$distributor_id]['Distributor']['code'] : null;
                }
                $email_contacts = array_merge($email_admin, $distributor_email);
                $email_subject = strtr($email_subject_pattern, array(
                    '[MA_DON]' => $v['OrdersDistributor']['code'],
                    '[VUNG_MIEN]' => $v['OrdersDistributor']['region_name'],
                    '[THANH_PHO]' => $v['OrdersDistributor']['region_parent_name'],
                ));
                $params = array(
                    'email' => $email_contacts,
                    'subject' => $email_subject,
                );
            }
        }
    }

    protected function sendEmail() {
        
    }

}
