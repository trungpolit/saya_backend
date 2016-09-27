<?php

class DailyReportsController extends AppController {

    public $uses = array(
        'DailyReport',
        'Distributor',
        'Region',
        'Setting',
        'User',
    );

    public function index() {
        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('daily_report_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('daily_report_title'));

        $options = array(
            'recursive' => -1,
            'order' => array(
                'date' => 'DESC',
            ),
        );

        $this->setSearchConds($options);

        $this->Paginator->settings = $options;
        $list_data = $this->Paginator->paginate($this->modelClass);

        // lấy ra thông tin tất cả nhóm Distributor
        $distributors = $this->Distributor->getList();
        $this->set('distributors', $distributors);

        // lấy ra danh sách region theo dạng tree phân cấp
        $regionTree = $this->Region->getTree();
        $this->set('regionTree', $regionTree);

        $regions = $this->Region->getChildrenFromTree($regionTree);
        $this->set('regions', $regions);

        $this->set('list_data', $list_data);
    }

    protected function setSearchConds(&$options) {
        if (isset($this->request->query['region_id']) && strlen($this->request->query['region_id'])) {
            $options['conditions']['DailyReport.region_id'] = $this->request->query['region_id'];
        }
        if (isset($this->request->query['distributor_id']) && strlen($this->request->query['distributor_id'])) {
            $options['conditions']['DailyReport.distributor_id'] = $this->request->query['distributor_id'];
        }
        if (isset($this->request->query['date_start']) && strlen(trim($this->request->query['date_start']))) {
            $this->request->query['date_start'] = trim($this->request->query['date_start']);
            $options['conditions']['DailyReport.date >='] = date('Ymd', strtotime($this->request->query['date_start']));
        }
        if (isset($this->request->query['date_end']) && strlen(trim($this->request->query['date_end']))) {
            $this->request->query['date_end'] = trim($this->request->query['date_end']);
            $options['conditions']['DailyReport.date <='] = date('Ymd', strtotime($this->request->query['date_end']));
        }
    }

    protected function setInit() {
        $this->set('model_name', $this->modelClass);
        // lấy ra thiết lập refresh
        $refresh_setting = $this->Setting->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'key' => 'DAILY_REPORT_REFRESH',
            ),
        ));
        $refresh = !empty($refresh_setting['Setting']) ?
                (int) $refresh_setting['Setting']['value'] : DAILY_REPORT_REFRESH;
        $this->set('refresh', $refresh);
    }

}
