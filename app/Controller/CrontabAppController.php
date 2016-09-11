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

}
