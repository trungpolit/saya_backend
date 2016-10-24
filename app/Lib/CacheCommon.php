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
        // Thực hiện tạo ra GZ file, dùng tối ưu hóa
        self::writeGZ($cache_path, $content);
        return $file->write($content);
    }

    static public function parseFileUri(&$data, $file_fields) {
        if (empty($data)) {
            return;
        }
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

    static public function writeGZ($cache_path, $content) {
        // Thực hiện tạo ra gz file
        $ext = pathinfo($cache_path, PATHINFO_EXTENSION);
        $cache_gz_path = str_replace('.' . $ext, '.gz', $cache_path);
        if (file_exists($cache_gz_path)) {
            unlink($cache_gz_path);
        }
        $file_gz = new File($cache_gz_path, true);
        $conent_gz = gzencode($content, 9);
        return $file_gz->write($conent_gz);
    }

    static public function delete($cache_path) {
        if (DIRECTORY_SEPARATOR == '\\') {
            $cache_path = str_replace('/', '\\', $cache_path);
        }
        if (file_exists($cache_path)) {
            unlink($cache_path);
        }
        // Thực hiện tạo ra gz file
        $ext = pathinfo($cache_path, PATHINFO_EXTENSION);
        $cache_gz_path = str_replace('.' . $ext, '.gz', $cache_path);
        if (file_exists($cache_gz_path)) {
            unlink($cache_gz_path);
        }
    }

}
