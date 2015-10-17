<?php

App::uses('Controller', 'Controller');

class ServiceAppController extends Controller {

    /**
     * setInit
     * Khởi tạo chế độ debug, thực hiện set json header
     * Xử lý các tham số được dùng chung của các service
     */
    protected function setInit() {

        $this->debugInit();
    }

    /**
     * debugInit
     * thực hiện khởi tạo debug log
     * thực hiện tự động tạo ra trans_id, log_file_name nếu không được định nghĩa
     * thực hiện lưu lại $this->request
     * 
     * @return mixed
     */
    protected function debugInit() {

        if (!isset($this->debug_mode) || $this->debug_mode < 1) {

            return;
        }
        if (empty($this->trans_id)) {

            $this->trans_id = uniqid();
        }
        if (empty($this->log_file_name)) {

            $this->log_file_name = $this->name . '_' . $this->action;
        }

        $this->logAnyFile(__('Init transaction id %s', $this->trans_id), $this->log_file_name);
        $this->logAnyFile(__('Request Header data req_header_%s', $this->trans_id), $this->log_file_name);
        $this->logAnyFile($this->getallheaders(), $this->log_file_name);
        $this->logAnyFile(__('Request GET data req_get_%s', $this->trans_id), $this->log_file_name);
        $this->logAnyFile($this->request->query, $this->log_file_name);
        $this->logAnyFile(__('Request POST data req_post_%s', $this->trans_id), $this->log_file_name);
        $this->logAnyFile($this->request->data, $this->log_file_name);

        if ($this->debug_mode >= 2) {

            $this->logAnyFile(__('Request user agent ua_%s', $this->trans_id), $this->log_file_name);
            $this->logAnyFile($this->request->header('User-Agent'), $this->log_file_name);
        }

        if ($this->debug_mode >= 3) {

            // thực hiện khởi tạo lấy về output thực chất được trả về client, chứa cả các thông báo notice php nếu có
            ob_start();
        }
    }

    /**
     * debugResponse
     * thực hiện debug log trước khi response dữ liệu trả về
     * đối với trường hợp $this->debug_mode = 2, thì thực hiện lưu lại database query
     * 
     * @return mixed
     */
    protected function debugResponse() {

        if (!isset($this->debug_mode) || $this->debug_mode < 1) {

            return;
        }

        $this->logAnyFile(__('Response data res_%s', $this->trans_id), $this->log_file_name);

        if ($this->isJson($this->response)) {

            $response = json_encode(json_decode($this->response, true), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            $this->logAnyFile($response, $this->log_file_name);
        } else {

            $this->logAnyFile($this->response, $this->log_file_name);
        }

        if ($this->debug_mode >= 2) {

            App::uses('ConnectionManager', 'Model');
            $db = ConnectionManager::getDataSource('default');
            $this->logAnyFile(__('Database query que_%s', $this->trans_id), $this->log_file_name);
            $this->logAnyFile($db->getLog(), $this->log_file_name);
        }

        if ($this->debug_mode >= 3) {

            // thực hiện khởi tạo lấy về output thực chất được trả về client, chứa cả các thông báo notice php nếu có
            $raw_response = ob_get_contents();
            $this->logAnyFile(__('Raw output o_%s response to client', $this->trans_id), $this->log_file_name);
            $this->logAnyFile($raw_response, $this->log_file_name);
        }
    }

    /**
     * isJson
     * kiểm tra xem chuỗi string có phải là json k?
     * 
     * @param string $string
     * @return bool
     */
    protected function isJson($string) {

        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function resError($code, $options = array()) {

        $this->setJsonHeader();

        if (empty($options['config'])) {

            $config = $this->name;
        } else {

            $config = $options['config'];
        }


        if (empty($options['message'])) {

            $config_path = 'message_code.' . $config . '.' . $code;
            $message = Configure::read($config_path);
            if (empty($message)) {

                throw new NotImplementedException(__('%s config was not defined', $config_path));
            }
        } else {

            $message = $options['message'];
        }

        if (!empty($options['message_args'])) {

            $message_args = $options['message_args'];
            if (!is_array($message_args)) {

                $message_args = explode(',', $message_args);
            }
            array_unshift($message_args, $message);
            $message = call_user_func_array('__', $message_args);
        }

        $data = !empty($options['data']) ? $options['data'] : null;

        $res = array(
            'status' => 'error',
            'code' => $code,
            'message' => $message,
            'data' => $data,
        );
        $this->response = json_encode($res);

        echo $this->response;
        $this->debugResponse();
        exit();
    }

    public function resFail($message, $data = null) {

        $this->setJsonHeader();

        $res = array(
            'status' => 'fail',
            'message' => $message,
            'data' => $data,
        );
        $this->response = json_encode($res);

        echo $this->response;
        $this->debugResponse();
        exit();
    }

    public function resSuccess($res) {

        $this->setJsonHeader();

        $res['status'] = 'success';
        $this->response = json_encode($res);

        echo $this->response;
        $this->debugResponse();
        exit();
    }

    protected function setJsonHeader() {

        $this->autoRender = false;
        header('Content-Type: application/json');
    }

    /**
     * logAnyFile
     * 
     * @param mixed $content
     * @param string $file_name
     */
    protected function logAnyFile($content, $file_name) {

        CakeLog::config($file_name, array(
            'engine' => 'File',
            'types' => array($file_name),
            'file' => $file_name,
        ));

        $this->log($content, $file_name);
    }

}
