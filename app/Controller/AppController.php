<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Session',
        'Paginator',
        'DebugKit.Toolbar',
    );
    public $helpers = array('Common');
    public $paginate = array(
        'limit' => 20,
        'order' => array(
            'modified' => 'DESC',
        ),
    );

    public function reqUpload() {

        $this->autoRender = false;
        App::import('Vendor', 'CustomUploadHandler', array('file' => 'UploadHandler/server/php' . DS . 'CustomUploadHandler.php'));
        $log_file_name = __CLASS__ . '_' . __FUNCTION__;

        $upload_handler = new CustomUploadHandler();
        $result = $upload_handler->post(false);

        if (empty($result['files'][0])) {

            $this->logAnyFile(__('File upload proccess was failed, raw result: '), $log_file_name);
            $this->logAnyFile($result, $log_file_name);

            echo json_encode($result);
            return false;
        }

        if (!isset($this->FileManaged)) {

            $this->loadModel('FileManaged');
        }

        $file = &$result['files'][0];
        $save_data = array(
            'name' => $file->name,
            'size' => $file->size,
            'mime' => $file->type,
            'status' => 0,
            'uri' => WEBROOT_DIR . DS . 'tmp' . DS . $file->name,
        );

        $this->FileManaged->create();
        $this->FileManaged->save($save_data);
        $file_managed_id = $this->FileManaged->getLastInsertID();

        // đọc lại thông tin file
        $file_managed = $this->FileManaged->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'id' => $file_managed_id,
            ),
        ));

        // chuỗi hóa thông tin về file
        $file->fileSerialize = json_encode($file_managed['FileManaged']);

        // thực hiện ghi đè lại deleteUrl
        $deleteUrl = Router::url(array(
                    'action' => 'reqDeleteFile',
                    '?' => array(
                        'file_managed_id' => $file_managed_id,
        )));
        $file->deleteUrl = $deleteUrl;

        echo json_encode($result);
    }

    public function reqDeleteFile() {

        $this->autoRender = false;

        if ($this->request->is('delete') || $this->request->is('post')) {

            $file_managed_id = $this->request->query('file_managed_id');
            $result = array(
                'success' => true
            );

            if (!isset($this->FileManaged)) {

                $this->loadModel('FileManaged');
            }

            $get_file = $this->FileManaged->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'id' => $file_managed_id,
                    'status' => 0, // chỉ được phép xóa file tạm
                )
            ));

            if (empty($get_file)) {

                echo json_encode($result);
                return;
            }

            $uri = $get_file['FileManaged']['uri'];

            if ($this->FileManaged->delete($file_managed_id, false)) {

                $file = new File(APP . $uri, false);
                $file->delete();

                echo json_encode($result);
                return;
            } else {

                echo json_encode(array(
                    'success' => false,
                    'message' => __('Can not delete FileManaged due to id=%s', $file_managed_id),
                ));
            }
        }
    }

    /**
     * Delete a record
     * 
     * @author trungnq
     * @param type $id
     */
    public function reqDelete($id = null) {

        $this->autoRender = false;
        $res = array(
            'error_code' => 0,
            'message' => __('delete_successful_message'),
        );
        if (!$this->request->is('post')) {

            $res = array(
                'error_code' => 1,
                'message' => __('invalid_data'),
            );
            echo json_encode($res);
            return;
        }
        $model_name = $this->request->data('model_name');
        if (!$this->$model_name) {

            $this->loadModel($model_name);
        }

        $check_exist = $this->$model_name->find('first', array(
            'conditions' => array(
                'id' => array(
                    '$eq' => $id,
                ),
            ),
        ));

        if (empty($check_exist)) {

            $res = array(
                'error_code' => 2,
                'message' => __('invalid_data'),
            );
            echo json_encode($res);
            return;
        }

        if ($this->$model_name->delete($id)) {

            echo json_encode($res);
        } else {

            $res = array(
                'error_code' => 3,
                'message' => __('delete_error_message'),
            );
            echo json_encode($res);
        }
    }

    /**
     * Delete a record
     * 
     * @author trungnq
     * @param type $id
     */
    public function reqEdit($id = null) {

        $this->autoRender = false;
        $res = array(
            'error_code' => 0,
            'message' => __('save_successful_message'),
        );
        if (!$this->request->is('post')) {

            $res = array(
                'error_code' => 1,
                'message' => __('invalid_data'),
            );
            echo json_encode($res);
            return;
        }
        $model_name = $this->request->data('model_name');

        if (!$this->$model_name) {

            $this->loadModel($model_name);
        }
        $check_exist = $this->$model_name->find('first', array(
            'conditions' => array(
                'id' => array(
                    '$eq' => $id,
                ),
            ),
        ));
        if (empty($check_exist)) {

            $res = array(
                'error_code' => 2,
                'message' => __('invalid_data'),
            );
            echo json_encode($res);
            return;
        }

        $this->request->data['id'] = $id;
        $save_data = $this->request->data;
        if ($this->$model_name->save($save_data)) {

            $this->Session->setFlash(__('save_successful_message'), 'default', array(), 'good');
            echo json_encode($res);
        } else {

            $res = array(
                'error_code' => 3,
                'message' => __('save_error_message'),
            );
            echo json_encode($res);
            return;
        }
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
