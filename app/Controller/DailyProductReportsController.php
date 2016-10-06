<?php

class DailyProductReportsController extends AppController {

    public $uses = array(
        'DailyProductReport',
        'Distributor',
        'Region',
        'Setting',
        'User',
        'Product',
    );

    public function index() {
        $this->setInit();

        $breadcrumb = array();
        $breadcrumb[] = array(
            'url' => Router::url(array('action' => 'index')),
            'label' => __('daily_product_report_title'),
        );
        $this->set('breadcrumb', $breadcrumb);
        $this->set('page_title', __('daily_product_report_title'));

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

        $products = $this->Product->getList();
        $this->set('products', $products);

        $this->set('list_data', $list_data);
    }

    protected function setSearchConds(&$options) {
        if (isset($this->request->query['region_id']) && strlen($this->request->query['region_id'])) {
            $options['conditions']['DailyProductReport.region_id'] = $this->request->query['region_id'];
        }
        if (isset($this->request->query['distributor_id']) && strlen($this->request->query['distributor_id'])) {
            $options['conditions']['DailyProductReport.distributor_id'] = $this->request->query['distributor_id'];
        }
        if (isset($this->request->query['date_start']) && strlen(trim($this->request->query['date_start']))) {
            $this->request->query['date_start'] = trim($this->request->query['date_start']);
            $options['conditions']['DailyProductReport.date >='] = date('Ymd', strtotime($this->request->query['date_start']));
        }
        if (isset($this->request->query['date_end']) && strlen(trim($this->request->query['date_end']))) {
            $this->request->query['date_end'] = trim($this->request->query['date_end']);
            $options['conditions']['DailyProductReport.date <='] = date('Ymd', strtotime($this->request->query['date_end']));
        }
    }

    public function reqDistributorByRegionId() {
        $this->layout = 'ajax';
        $this->setInit();
        $region_id = $this->request->query('region_id');
        $options = array(
            'fields' => array(
                'id', 'name',
            ),
            'conditions' => array(
                'Distributor.status' => STATUS_PUBLIC,
            ),
            'order' => array(
                'Distributor.weight' => 'ASC',
                'Distributor.modified' => 'DESC',
            ),
        );
        if (!empty($region_id)) {
            $options['joins'] = array(
                array('table' => 'distributors_regions',
                    'alias' => 'DistributorsRegion',
                    'type' => 'INNER',
                    'conditions' => array(
                        'DistributorsRegion.distributor_id = Distributor.id',
                    )
                )
            );
            $options['conditions']['DistributorsRegion.region_id'] = $region_id;
        }
        $distributors = $this->Distributor->find('list', $options);
        $this->set('distributors', $distributors);

        $disable_label = $this->request->query('disable_label');
        $this->set('disable_label', $disable_label);
    }

    public function reqProductByDistributorId() {
        $this->layout = 'ajax';
        $this->setInit();
        $distributor_id = $this->request->query('distributor_id');
        $region_id = $this->request->query('region_id');
        $options = array(
            'fields' => array(
                'id', 'name',
            ),
            'conditions' => array(
                'Product.status' => STATUS_PUBLIC,
                'Product.distributor_id' => $distributor_id,
                'Product.region_id' => $region_id,
            ),
            'order' => array(
                'Product.weight' => 'ASC',
                'Product.modified' => 'DESC',
            ),
        );
        $products = $this->Product->find('list', $options);
        $this->set('products', $products);

        $disable_label = $this->request->query('disable_label');
        $this->set('disable_label', $disable_label);
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
