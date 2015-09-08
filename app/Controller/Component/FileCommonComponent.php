<?php

class FileCommonComponent extends Component {

    public $controller = '';
    public $types = array(
        'banner',
        'logo',
        'icon',
        'thumbnail',
        'image',
        'screen_shot',
        'binary',
        'text',
        'config_jad',
        'video',
        'audio',
        'trailer',
        'trail_binary',
        'video_thumb',
    );

    public function initialize(\Controller $controller) {

        parent::initialize($controller);

        $this->controller = $controller;
    }

    /**
     * getSingleFile
     * 
     * @param object $model
     * @param int $object_id
     * @param string $type
     * @param array $qrcode_opts
     * 
     * @return mixed or array
     */
    public function getSingleFile($model, $object_id, $type, $qrcode_opts = array()) {

        if (!empty($this->controller) && !isset($this->controller->FileUsage)) {

            $this->controller->loadModel('FileUsage');
        }

        if (!empty($this->controller) && !isset($this->controller->FileManaged)) {

            $this->controller->loadModel('FileManaged');
        }

        $get_file_usage = $this->controller->FileUsage->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'object_id' => $object_id,
                'table_name' => $model->useTable,
                'type' => $type,
            ),
        ));

        if (empty($get_file_usage)) {

            return false;
        }

        $file_managed_id = $get_file_usage['FileUsage']['file_managed_id'];

        $get_file_managed = $this->controller->FileManaged->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'id' => $file_managed_id,
            ),
        ));

        if (empty($get_file_managed)) {

            return false;
        }

        // nếu có options cần lấy ra thông tin về qrcode
        if (!empty($qrcode_opts['get'])) {

            $force = !empty($qrcode_opts['force']) ? $qrcode_opts['force'] : false;
            $qrcode = $this->getSingleFileQRCode($get_file_managed, $force);

            $get_file_managed['FileManaged']['qrcode'] = $qrcode;
        }

        return $get_file_managed['FileManaged'];
    }

    /**
     * generateFolderStructure
     * Thực hiện tạo ra cấu trúc thư mục lưu trữ [Tên module/Tên ext/năm/tháng/ngày/khối block]
     * 
     * @param string $module_name
     * @param string $ext
     * 
     * @return string
     */
    public function generateFolderStructure($module_name, $ext, $absolute = false) {

        $data_root_name = Configure::read('gom.data_root');
        $ext = strtoupper($ext);
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $block = rand(1, 2000);
        $folder_structure = array(
            $data_root_name,
            $module_name,
            $ext,
            $year,
            $month,
            $day,
            $block,
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

    public function moveFromTmp($file, $module_name) {

        if (empty($file)) {

            return;
        }

        if (!is_array($file)) {

            $file = array($file);
        }

        foreach ($file as $v) {

            $item = json_decode($v, true);
            if (empty($item)) {

                throw new CakeException(__('Lỗi, không thực hiện move được file do xử lý không hợp lệ'));
            }

            // kiểm tra xem file đã được move hay chưa?
            if (!empty($item['status'])) {

                continue;
            }

            $file_obj = new File(APP . WEBROOT_DIR . DS . $item['uri'], false);
            if (!$file_obj->exists()) {

                throw new CakeException(__('Lỗi, không thực hiện move được file do file không tồn tại'));
            }

            $file_name = basename($item['uri']);
            $file_ext = substr(strrchr($file_name, '.'), 1);

            $target = $this->generateFolderStructure($module_name, $file_ext);

            $copy = $file_obj->copy(APP . $target . $file_name);

            if (!$copy) {

                throw new CakeException(__('Lỗi, không thực hiện move được file'));
            }
            $file_obj->delete();

            // cập nhật lại đường dẫn file và set status = 1
            $item['uri'] = $target . $file_name;
            $item['status'] = 1;

            if (!isset($this->controller->FileManaged)) {

                $this->controller->loadModel('FileManaged');
            }

            if (!$this->controller->FileManaged->save($item)) {

                throw new CakeException(__('Lỗi, không cập nhật được đường dẫn file mới sau khi move'));
            }
        }
    }

    public function getFileUsage($table_name, $object_id, $types) {

        if (empty($types)) {

            $types = $this->types;
        }

        if (!isset($this->controller->FileUsage)) {

            $this->controller->loadModel('FileUsage');
        }

        $file_usage = array();

        foreach ($types as $type) {

            $get_file = $this->controller->FileUsage->find('all', array(
                'recursive' => -1,
                'conditions' => array(
                    'table_name' => $table_name,
                    'object_id' => $object_id,
                    'type' => $type,
                ),
                'contain' => array('FileManaged'),
            ));

            if (empty($get_file)) {

                $file_usage[$type] = json_encode(array());
                continue;
            }

            foreach ($get_file as $v) {

                $file_managed = !empty($v['FileManaged']) ?
                        json_encode($v['FileManaged']) : json_encode(array());
                $file_usage[$type][] = $file_managed;
            }
        }

        return $file_usage;
    }

}
