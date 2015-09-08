<?php

class UtilityCommon {

    public static function convert_vi_to_en($str) {

        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ|Ð)/", 'D', $str);
        //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        return $str;
    }

    /**
     * isASCII
     * Thực hiện kiểm tra chuỗi string có phải là ASCII k?
     * 
     * @param string $str
     * @return boolean
     */
    public static function isASCII($str) {

        return mb_detect_encoding($str, 'ASCII', true);
    }

    /**
     * forceConvertASCII
     * 
     * @param string $str
     * @return string
     */
    public static function forceConvertASCII($str) {

        $ascii_str = @iconv("UTF-8", "us-ascii//TRANSLIT", $str);
        return $ascii_str;
    }

    /**
     * getMimeType
     * nhận dạng mime type của file thông qua đuôi mở rộng
     * @param string $filename
     * @return string
     */
    public static function getMimeType($filename) {

        $mimePath = APP . 'Lib' . DS . 'mime.types';
        $fileext = substr(strrchr($filename, '.'), 1);
        if (empty(
                        $fileext))
            return (false);
        $regex = "/^([\w\+\-\.\/]+)\s+(\w+\s)*($fileext\s)/i";
        $lines = file("$mimePath/mime.types");
        foreach ($lines as $line) {
            if (substr($line, 0, 1) == '#')
                continue; // skip comments 
            $line = rtrim($line) . " ";
            if (!preg_match($regex, $line, $matches))
                continue; // no match to the extension 
            return ($matches[1]);
        }
        return (false); // no match at all 
    }

    /**
     * generateRandomLetters
     * thực tạo ra các kí tự ngẫu nhiên
     * 
     * @param int $length
     * @return string
     */
    public static function generateRandomLetters($length) {

        $random = '';

        for ($i = 0; $i < $length; $i++) {

            $random .= chr(rand(ord('a'), ord('z')));
        }
        return $random;
    }

    /**
     * normalizeUrl
     * hàm chuyển đổi các kí tự đặc biệt, dấu cách thành dạng có dấu gạch ngang và viết thường
     * trong việc tạo ra folder trong dựa vào file name
     * 
     * @param string $str
     * @return string
     */
    public static function normalizeUrl($str) {

        $str = self::convert_vi_to_en($str);
        $str = preg_replace("![^a-z0-9]+!i", "-", mb_strtolower($str, "UTF-8"));
        return $str;
    }

    /**
     * generateFolderStructure
     * Thực hiện tạo ra cấu trúc thư mục lưu trữ [Tên module/Tên ext/nămtháng/ngày]
     * 
     * @param string $module_name
     * @param string $ext
     * 
     * @return string
     */
    public static function generateFolderStructure($module_name, $mime, $absolute = false) {

        App::uses('Folder', 'Utility');
        App::uses('File', 'Utility');

        $data_root_name = Configure::read('sysconfig.App.data_file_root');

        $pretty_mime = strtolower($mime);
        $extract_mime = explode('/', $pretty_mime);

        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $folder_structure = array(
            $data_root_name,
            $module_name,
            $extract_mime[0],
            $year . $month,
            $day,
        );
        $folder_path = APP;

        foreach ($folder_structure as $item) {

            $folder_path .= DS . $item;
            $folder = new Folder($folder_path, false, 0777);
            if (!$folder->inPath($folder_path)) {

                $folder = new Folder($folder_path, true, 0777);
            }
        }

        if ($absolute) {

            return $folder_path . DS;
        }

        return str_replace(APP, '', $folder_path . DS);
    }

    /**
     * moveFromTmp
     * Thực hiện chuyển file từ thư mục tmp vào thư mục target
     * 
     * @param array $file
     * @param string $module_name - Tên thư mục Module cần chuyển file vào
     * 
     * @return boolean|\MongoId
     * @throws CakeException
     */
    static public function moveFromTmp($file, $module_name) {

        if (empty($file)) {

            return false;
        }

        $status_file_upload_completed = Configure::read('sysconfig.App.constants.STATUS_FILE_UPLOAD_COMPLETED');
        $file_ids = array();

        if (!is_array($file)) {

            $file = array($file);
        }

        foreach ($file as $v) {

            $item = json_decode($v, true);
            if (empty($item)) {

                throw new CakeException(__('The input file is invalid'));
            }

            // kiểm tra xem file đã được move hay chưa?
            if ($item['status'] == $status_file_upload_completed) {

                $file_ids[] = new MongoId($item['id']);
                continue;
            }

            $file_uri = APP . WEBROOT_DIR . DS . $item['uri'];

            // thực hiện support cho môi trường windows
            if (DIRECTORY_SEPARATOR == '\\') {

                $file_uri = str_replace('\\', '/', $file_uri);
            }

            $file_obj = new File($file_uri, false, 0755);
            if (!$file_obj->exists()) {

                throw new CakeException(__('The input file is not exist'));
            }

            $file_name = basename($item['uri']);

            if (!empty($item['mime'])) {

                $mime = $item['mime'];
            } else {

                $mime = ExtendedUtility::getMimeType($file_name);
            }

            $target = ExtendedUtility::generateFolderStructure($module_name, $mime);

            $copy = $file_obj->copy(APP . $target . $file_name);

            if (!$copy) {

                throw new CakeException(__('Can not copy file from %s to %s', $file_obj->path, APP . $target . $file_name));
            }
            $file_obj->delete();

            // cập nhật lại đường dẫn file và set status = 1
            $item['uri'] = $target . $file_name;
            $item['status'] = $status_file_upload_completed;

            App::uses('FileManaged', 'Model');
            $FileManaged = new FileManaged();
            if (!$FileManaged->save($item)) {

                throw new CakeException(__('Cant save file data into File Collection'));
            }

            $file_ids[] = new MongoId($item['id']);
        }

        return $file_ids;
    }

}
