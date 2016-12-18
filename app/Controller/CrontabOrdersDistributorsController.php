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

        // Thực hiện khóa crontab
        $this->lock();

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
                'NOT' => array(
                    'sent_status' => array(
                        STATUS_SEND_SUCCESS,
                        STATUS_SEND_EXCEPTION,
                    ),
                ),
                'status' => STATUS_PENDING,
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
                    $distributor_email = !empty($distributors[$distributor_id]['Distributor']['email']) ?
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
                    'region_name' => $v['OrdersDistributor']['region_name'],
                    'region_parent_name' => $v['OrdersDistributor']['region_parent_name'],
                    'created' => $v['OrdersDistributor']['created'],
                    'code' => $v['OrdersDistributor']['code'],
                    'customer_name' => $v['OrdersDistributor']['customer_name'],
                    'customer_mobile' => $v['OrdersDistributor']['customer_mobile'],
                    'customer_mobile2' => $v['OrdersDistributor']['customer_mobile2'],
                    'customer_address' => $v['OrdersDistributor']['customer_address'],
                    'total_qty' => $v['OrdersDistributor']['total_qty'],
                    'total_price' => $v['OrdersDistributor']['total_price'],
                    'id' => $v['OrdersDistributor']['id'],
                    'distributor_id' => $distributor_id,
                    'distributor_code' => $distributor_code,
                    'distributor_name' => $distributor_name,
                );
                // Lấy ra danh sách sản phẩm
                $cache_data = $v['OrdersDistributor']['cache_data'];
                $decoded_data = unserialize($cache_data);
                $params['items'] = $decoded_data;

                $this->sendEmail($params);
            }
        }
    }

    protected function sendEmail($params) {
        if (empty($params['items'])) {
            $this->logAnyFile(__('ERROR: Dữ liệu trong trường cache_data không hợp lệ với id="%s"', $params['id']), $this->log_file_name);

            $this->OrdersDistributor->save(array(
                'id' => $params['id'],
                'sent_status' => STATUS_SEND_EXCEPTION,
                'sent_message' => 'Dữ liệu trong trường cache_data không hợp lệ',
            ));
            return false;
        }
        if (empty($params['email'])) {
            $this->logAnyFile(__('ERROR: Dữ liệu trong trường cache_data không hợp lệ với id="%s"', $params['id']), $this->log_file_name);

            $this->OrdersDistributor->save(array(
                'id' => $params['id'],
                'sent_status' => STATUS_SEND_EXCEPTION,
                'sent_message' => 'Không tồn tại email nào để gửi đi',
            ));
            return false;
        }
        $this->logAnyFile(__('SEND_EMAIL: Thực hiện xử lý gửi email cho distributor_id="%s", distributor_code="%s", distributor_name="%s"', $params['distributor_id'], $params['distributor_code'], $params['distributor_name']), $this->log_file_name);
        $email_template = 'invoice';

        $Email = new CakeEmail();
        $Email->config('default');
        $EmailConfig = new EmailConfig();
        $params['from'] = $EmailConfig->default['from'];
        $Email->template($email_template);
        $Email->emailFormat('html')
                ->subject($params['subject'])->from(array($params['from'] => 'cskh'))
                ->to($params['email']);
        $Email->viewVars($params);
        try {
            $content = $Email->send();
            $this->logAnyFile(__('email "%s" được gửi tới "%s" thành công, nội dung:', $params['subject'], implode(',', $params['email'])), $this->log_file_name);
            $this->logAnyFile($content, $this->log_file_name);

            $this->OrdersDistributor->save(array(
                'id' => $params['id'],
                'sent_status' => STATUS_SEND_SUCCESS,
                'sent_at' => date('Y-m-d H:i:s'),
                'sent_content' => $content['message'],
                'sent_to' => implode(',', $params['email']),
                'sent_from' => $params['from'],
                'sent_subject' => $params['subject'],
            ));

            return $content;
        } catch (Exception $ex) {
            $this->logAnyFile(__("Không gửi được email: %s, chi tiết:", $ex->getMessage()), $this->log_file_name);
            $this->logAnyFile($ex->getTraceAsString(), $this->log_file_name);

            $this->OrdersDistributor->save(array(
                'id' => $params['id'],
                'sent_status' => STATUS_SEND_FAIL,
                'sent_at' => date('Y-m-d H:i:s'),
                'sent_to' => implode(',', $params['email']),
                'sent_from' => $params['from'],
                'sent_message' => $ex->getMessage(),
                'sent_message_variables' => $ex->getTraceAsString(),
                'sent_subject' => $params['subject'],
            ));

            return false;
        }
    }

}
