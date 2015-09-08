<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class CacheCommon {

    static public function write($cache_path, $content) {

        if (DIRECTORY_SEPARATOR == '\\') {

            $cache_path = str_replace('\\', '/', $cache_path);
        }

        $file = new File($cache_path);
        return $file->write($content);
    }

}
