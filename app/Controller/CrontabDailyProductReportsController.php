<?php

App::uses('CrontabAppController', 'Controller');

class CrontabDailyProductReportsController extends CrontabAppController {

    public $uses = array(
        'Distributor',
        'OrdersProduct',
        'DailyProductReport',
    );
    public $log_file_name = null;

    public function index() {
        $this->autoRender = false;
        $this->log_file_name = __CLASS__ . '_' . __FUNCTION__;
        $date = $this->request->query('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        $date_int = (int) $date;
        $distributor_id = $this->request->query('distributor_id');
        if (empty($distributor_id)) {
            $distributors = $this->Distributor->find('all', array(
                'recursive' => -1,
            ));
            $distributor_id = Hash::extract($distributors, '{n}.Distributor.id');
        } else {
            $distributor_id = $this->parseStrToArr($distributor_id);
            $distributors = $this->Distributor->find('all', array(
                'recursive' => -1,
                'conditions' => array(
                    'Distributor.id' => $distributor_id,
                ),
            ));
        }
        $this->logAnyFile(__("BEGIN: Thực hiện thống kê cho Distributor=(%s)", implode(',', $distributor_id)), $this->log_file_name);
        if (empty($distributors)) {
            $this->logAnyFile("Không thực hiện thống kê, do không tồn tại Distributor nào", $this->log_file_name);
        }
        // Thực hiện xóa hết các thống kê cũ để thống kê lại
        $this->DailyProductReport->deleteAll(array(
            'distributor_id' => $distributor_id,
            'date' => $date_int,
                ), false);

        $options = array(
            'conditions' => array(
                'distributor_id' => $distributor_id,
            ),
        );
        $stats = $this->OrdersProduct->stats($options);
        if (empty($stats)) {
            $this->logAnyFile(__("Không tồn tại thống kê nào cho Distributor=(%s)", implode(',', $distributor_id)), $this->log_file_name);
            exit();
        }

        $save_data = array();
        foreach ($stats as $k => $v) {
            $save_data[$k] = array(
                'date' => $date_int,
                'region_id' => $v['OrdersProduct']['region_id'],
                'region_name' => $v['OrdersProduct']['region_name'],
                'distributor_id' => $v['OrdersProduct']['distributor_id'],
                'distributor_code' => $v['OrdersProduct']['distributor_code'],
                'product_id' => $v['OrdersProduct']['product_id'],
                'product_name' => $v['OrdersProduct']['product_name'],
                'total_qty' => $v['OrdersProduct']['total_qty'],
                'total_revernue' => $v['OrdersProduct']['total_revernue'],
            );
        }
        $this->DailyProductReport->saveAll($save_data);
        $this->logAnyFile(__("END: Thực hiện thống kê cho Distributor=(%s)", implode(',', $distributor_id)), $this->log_file_name);
    }

}
