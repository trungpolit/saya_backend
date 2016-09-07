<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class CacheCommon {

    static public function write($cache_path, $content) {
        if (DIRECTORY_SEPARATOR == '\\') {
            $cache_path = str_replace('/', '\\', $cache_path);
        }

        if (file_exists($cache_path)) {
            unlink($cache_path);
        }
        $file = new File($cache_path, true);
        return $file->write($content);
    }

    static public function parseFileUri(&$data, $file_fields) {
        foreach ($file_fields as $field) {
            $uri_field = $field . '_uri';
            foreach ($data as $k => $v) {
                if (empty($v[$uri_field])) {
                    continue;
                }
                $data[$k][$uri_field] = unserialize($v[$uri_field]);
            }
        }
    }

}
