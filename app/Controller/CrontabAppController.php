<?php

App::uses('Controller', 'Controller');

class CrontabAppController extends Controller {

    protected $_mergeParent = 'CrontabAppController';

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

    protected function parseStrToArr($raw_str, $delimiter = ',') {
        $str = trim($raw_str);
        $raw_arr = explode($delimiter, $str);
        foreach ($raw_arr as $k => $v) {
            $raw_arr[$k] = trim($v);
        }
        return $raw_arr;
    }

    protected function lock() {
        $f = fopen(TMP . 'logs' . DS . $this->log_file_name . '.lock', 'w') or die('Cannot create lock file');
        if (flock($f, LOCK_EX | LOCK_NB)) {
            return true;
        } else {
            $this->logAnyFile(__('LOCKED: Tiến trình xử lý trước đó vẫn đang hoạt động'), $this->log_file_name);
            exit();
        }
    }

}
