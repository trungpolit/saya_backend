<?php

App::uses('CrontabAppController', 'Controller');

class CrontabDailyReportsController extends CrontabAppController {

    public $uses = array(
        'Distributor',
        'DailyReport',
        'OrdersDistributor',
    );
    public $log_file_name = null;

    public function index() {
        $this->autoRender = false;
        $this->log_file_name = __CLASS__ . '_' . __FUNCTION__;
        $date = $this->request->query('date');
        if (empty($date)) {
            $date = date('Y-m-d');
        } else {
            $date = date('Y-m-d', strtotime($date));
        }
        $date_int = (int) date('Ymd', strtotime($date));
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
        $this->logAnyFile(__("BEGIN: Thực hiện thống kê cho Distributor=(%s), Ngày='%s'", implode(',', $distributor_id), $date), $this->log_file_name);
        if (empty($distributors)) {
            $this->logAnyFile("Không thực hiện thống kê, do không tồn tại Distributor nào", $this->log_file_name);
        }
        // Thực hiện xóa hết các thống kê cũ để thống kê lại
        $this->DailyReport->deleteAll(array(
            'distributor_id' => $distributor_id,
            'date' => $date_int,
                ), false);

        $options = array(
            'conditions' => array(
                'distributor_id' => $distributor_id,
                'created >=' => date('Y-m-d', strtotime($date)) . ' 00:00:00',
                'created <' => date('Y-m-d', strtotime('+1 day', strtotime($date))) . ' 00:00:00',
            ),
        );

        $save_data = array();
        $status_conf = array(
            STATUS_SUCCESS => 'success',
            STATUS_PENDING => 'pending',
            STATUS_PROCESSING => 'processing',
            STATUS_FAIL => 'fail',
            STATUS_BAD => 'bad',
        );
        $this->statsStatus($save_data, $status_conf, $options);
        if (empty($save_data)) {
            $this->logAnyFile(__("Không tồn tại thống kê nào cho Distributor=(%s)", implode(',', $distributor_id)), $this->log_file_name);
            exit();
        }

        foreach ($save_data as $k => $v) {
            $success = !empty($v['total_order_distributor_success']) ?
                    $v['total_order_distributor_success'] : 0;
            $pending = !empty($v['total_order_distributor_pending']) ?
                    $v['total_order_distributor_pending'] : 0;
            $processing = !empty($v['total_order_distributor_processing']) ?
                    $v['total_order_distributor_processing'] : 0;
            $fail = !empty($v['total_order_distributor_fail']) ?
                    $v['total_order_distributor_fail'] : 0;
            $bad = !empty($v['total_order_distributor_bad']) ?
                    $v['total_order_distributor_bad'] : 0;
            $total = $success + $pending + $processing + $fail + $bad;
            $save_data[$k]['total_order_distributor'] = $total;
            $save_data[$k]['date'] = $date_int;
        }

        $this->logAnyFile(__('Save: Thực hiện lưu trữ thống kê:'), $this->log_file_name);
        $this->logAnyFile($save_data, $this->log_file_name);

        $this->DailyReport->saveAll(array_values($save_data));
        $this->logAnyFile(__("END: Thực hiện thống kê cho Distributor=(%s)", implode(',', $distributor_id)), $this->log_file_name);
    }

    protected function statsStatus(&$save_data, $status_conf, $options) {
        $statuses = array_keys($status_conf);
        foreach ($statuses as $status) {
            if ($status == STATUS_SUCCESS) {
                $stats = $this->OrdersDistributor->stats($options);
            } else {
                $stats = $this->OrdersDistributor->statsStatus($status, $options);
            }
            if (empty($stats)) {
                continue;
            }
            foreach ($stats as $v) {
                $distributor_id = $v['OrdersDistributor']['distributor_id'];
                $region_id = $v['OrdersDistributor']['region_id'];
                $key = $region_id . '_' . $distributor_id;
                $save_data[$key] = !empty($save_data[$key]) ? $save_data[$key] : array();
                $save_data[$key]['region_id'] = $v['OrdersDistributor']['region_id'];
                $save_data[$key]['region_name'] = $v['OrdersDistributor']['region_name'];
                $save_data[$key]['distributor_id'] = $v['OrdersDistributor']['distributor_id'];
                $save_data[$key]['distributor_code'] = $v['OrdersDistributor']['distributor_code'];
                $alias = $status_conf[$status];
                $save_data[$key]['total_order_distributor_' . $alias] = $v[0]['count'];
                if ($status == STATUS_SUCCESS) {
                    $save_data[$key]['total_revernue'] = $v[0]['total_revernue'];
                }
            }
        }
    }

}
