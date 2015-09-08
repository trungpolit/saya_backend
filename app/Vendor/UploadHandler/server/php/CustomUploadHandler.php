<?php

App::uses('UtilityCommon', 'Lib');
require_once 'UploadHandler.php';

class CustomUploadHandler extends UploadHandler {

    public function __construct($options = null, $initialize = true, $error_messages = null) {

        // ghi đè lại thư mục cần upload
        $options = array(
            'script_url' => $this->get_full_url() . '/',
            'upload_dir' => dirname($this->get_server_var('SCRIPT_FILENAME')) . '/tmp/',
            'upload_url' => $this->get_full_url() . '/tmp/',
        );

        // ghi đè không cho tự động xử lý upload file khi khởi tạo object
        $initialize = false;

        parent::__construct($options, $initialize, $error_messages);
    }

    protected function trim_file_name($file_path, $name, $size, $type, $error, $index, $content_range) {

        // ghi đè vào phương thức đã có, làm đẹp file_name và tạo unique
        $unique = UtilityCommon::generateRandomLetters(5);
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $origin_name = basename($name, "." . $ext);
        $unique_name = UtilityCommon::normalizeUrl($origin_name) . '_' . $unique . '.' . $ext;

        // Remove path information and dots around the filename, to prevent uploading
        // into different directories or replacing hidden system files.
        // Also remove control characters and spaces (\x00..\x20) around the filename:
        $name = trim(basename(stripslashes($unique_name)), ".\x00..\x20");
        // Use a timestamp for empty filenames:
        if (!$name) {
            $name = str_replace('.', '-', microtime(true));
        }
        return $name;
    }
}
