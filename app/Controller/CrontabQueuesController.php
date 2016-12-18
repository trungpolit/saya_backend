<?php

App::uses('CrontabAppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

class CrontabQueuesController extends CrontabAppController {

    public $uses = array('CrontabQueue');
    public $log_file_name = null;

    const LIMIT = 100;

    public function index() {
        $this->autoRender = false;
        $this->log_file_name = __CLASS__ . '_' . __FUNCTION__;

        // Thực hiện khóa crontab
        $this->lock();

        $this->logAnyFile(__("BEGIN: Thực hiện chạy"), $this->log_file_name);
        while (1) {
            $crontab_queues = $this->CrontabQueue->find('all', array(
                'recursive' => -1,
                'limit' => self::LIMIT,
            ));
            if (empty($crontab_queues)) {
                $this->logAnyFile(__("END: kết thúc chạy"), $this->log_file_name);
                exit();
            }
            foreach ($crontab_queues as $v) {
                $this->run($v);
            }
        }
    }

    protected function run($v) {
        $url = FULL_BASE_URL . $v['CrontabQueue']['url'];
        $this->logAnyFile(__('Thực hiện gọi url "%s"', $url), $this->log_file_name);
        $HttpSocket = new HttpSocket();
        try {
            $HttpSocket->get($url);
            $this->logAnyFile('Thực hiện gọi thành công', $this->log_file_name);
            $this->CrontabQueue->delete($v['CrontabQueue']['id']);
        } catch (Exception $exc) {
            $this->logAnyFile(__('Thực hiện gọi thất bại "%s", chi tiết:', $exc->getMessage()), $this->log_file_name);
            $this->logAnyFile($exc->getTraceAsString(), $this->log_file_name);
            $save_data = array(
                'id' => $v['CrontabQueue']['id'],
                'status' => STATUS_FAIL,
                'message' => $exc->getMessage(),
                'message_variables' => $exc->getTraceAsString(),
            );
            $this->CrontabQueue->save($save_data);
        }
    }

}
