<?php

App::uses('ServiceAppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class OrderServicesController extends ServiceAppController {

    public $uses = array(
        'Order',
        'OrdersProduct',
        'OrdersDistributor',
        'Customer',
        'Product',
        'Distributor',
        'Setting',
    );
    public $debug_mode = 3;

    const ORDER_CODE_DELIMITER = 'N';
    const ORDER_BUNDLE_CODE_DELIMITER = 'A';

    public function create() {
        $this->log_file_name = __CLASS__ . '_' . __FUNCTION__;
        $this->setInit();

        $data = $this->request->query('order');
        if (empty($data)) {
            $this->resError('#ord001');
        }

        $decode = json_decode($data, true);
        if (empty($decode)) {
            $this->resError('#ord002');
        }

        $statuses = Configure::read('saya.Order.status');

        // trích xuất thông tin liên quan tới customer
        $user_agent = $this->request->header('User-Agent');
        $host = $this->request->host();
        $client_ip = $this->request->clientIp();

        $customer_data = $decode['customer'];
        $customer_data['region_id'] = $decode['region_id'];
        $customer_data['region_name'] = $decode['region_name'];
        $customer_data['region_parent_id'] = $decode['region_parent_id'];
        $customer_data['region_parent_name'] = $decode['region_parent_name'];
        $customer_data['platform_os'] = $decode['platform_os'];
        $customer_data['platform_version'] = $decode['platform_version'];
        $customer_data['user_agent'] = $user_agent;
        $customer_data['client_ip'] = $client_ip;
        $customer_data['host'] = $host;

        // kiểm tra xem customer có đang bị khóa hay không?
        $customer = $this->Customer->getInfoByCode($customer_data['code']);
        // nếu customer có trạng thái là -1: khóa, thì không cho tạo ra đơn hàng
        if (!empty($customer) && $customer['Customer']['status'] <= 0) {
            $this->resError('#ord003');
        }

        // nếu chưa tồn tại customer thì tạo mới
        if (empty($customer)) {
            $this->Customer->create();
            $this->Customer->save($customer_data);
            $customer_id = $this->Customer->getLastInsertID();
            $customer_data['id'] = $customer_id;

            $total_order = $total_order_distributor = 0;
            $total_order_pending = $total_order_distributor_pending = 0;
        }
        // nếu đã tồn tại rồi thì update
        else {
            $customer_id = $customer['Customer']['id'];
            $customer_data['id'] = $customer_id;
            $this->Customer->save($customer_data);

            $total_order = !empty($customer['Customer']['total_order']) ?
                    $customer['Customer']['total_order'] : 0;
            $total_order_distributor = !empty($customer['Customer']['total_order_distributor']) ?
                    $customer['Customer']['total_order_distributor'] : 0;
            $total_order_pending = !empty($customer['Customer']['total_order_pending']) ?
                    $customer['Customer']['total_order_pending'] : 0;
            $total_order_distributor_pending = !empty($customer['Customer']['total_order_distributor_pending']) ?
                    $customer['Customer']['total_order_distributor_pending'] : 0;
        }

        // lấy ra thông tin trong giỏ hàng
        $cart_data = $decode['cart'];
        if (empty($cart_data) || !is_array($cart_data)) {
            $this->resError('#ord004');
        }

        $order_distributor_data = $order_product_data = array();
        $order_distributor_cache = array();
        $total_qty = 0;
        $total_price = 0;

        $order_no = $total_order + 1;
        $order_code = $customer_id . self::ORDER_CODE_DELIMITER . $order_no;

        $distributors = array();
        $email_params = array();

        foreach ($cart_data as $v) {
            $product_id = $v['id'];
            $product = $this->Product->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'id' => $product_id,
                ),
            ));

            if (empty($product)) {
                continue;
            }

            $product_logo_uri = unserialize($product['Product']['logo_uri']);
            $distributor_id = $product['Product']['distributor_id'];
            $distributor_code = $product['Product']['distributor_code'];
            $price = $product['Product']['price'];
            $name = $product['Product']['name'];
            $unit = $product['Product']['unit'];
            $qty = (int) $v['qty'];

            if (!isset($distributors[$distributor_id])) {
                $get_distributor = $this->Distributor->findById($distributor_id);
                $distributors[$distributor_id] = !empty($get_distributor) ? $get_distributor['Distributor'] : array();
                $email_params[$distributor_id]['distributor_id'] = $distributor_id;
                $email_params[$distributor_id]['email'] = strlen($distributors[$distributor_id]['email']) ? explode(',', $distributors[$distributor_id]['email']) : array();
                $email_params[$distributor_id]['distributor_name'] = strlen($distributors[$distributor_id]['name']) ? $distributors[$distributor_id]['name'] : null;
                $email_params[$distributor_id]['distributor_code'] = strlen($distributors[$distributor_id]['code']) ? $distributors[$distributor_id]['code'] : null;
            }

            // nếu chưa tồn tại dữ liệu cho $order_distributor_data thì khởi tạo
            if (empty($order_distributor_data[$distributor_id])) {
                $order_distributor_data[$distributor_id] = array(
                    'customer_code' => $customer_data['code'],
                    'customer_id' => $customer_data['id'],
                    'customer_name' => $customer_data['name'],
                    'customer_mobile' => $customer_data['mobile'],
                    'customer_mobile2' => $customer_data['mobile2'],
                    'customer_address' => $customer_data['address'],
                    'region_id' => $decode['region_id'],
                    'region_name' => $decode['region_name'],
                    'region_parent_id' => $decode['region_parent_id'],
                    'region_parent_name' => $decode['region_parent_name'],
                    'distributor_id' => $distributor_id,
                    'distributor_code' => $distributor_code,
                    'order_code' => $order_code,
                    'total_qty' => 0,
                    'total_price' => 0,
                    'notes' => '',
                    'platform_os' => $decode['platform_os'],
                    'platform_version' => $decode['platform_version'],
                    'user_agent' => $user_agent,
                    'client_ip' => $client_ip,
                    'host' => $host,
                    'raw_data' => $data,
                    'status' => ORDER_DEFAULT_STATUS,
                );
                $order_distributor_cache[$distributor_id] = array();
            }

            $product_total_price = $qty * $price;

            $order_product_data[] = array(
                'customer_code' => $customer_data['code'],
                'customer_id' => $customer_data['id'],
                'region_id' => $decode['region_id'],
                'region_name' => $decode['region_name'],
                'region_parent_id' => $decode['region_parent_id'],
                'region_parent_name' => $decode['region_parent_name'],
                'distributor_id' => $distributor_id,
                'distributor_code' => $distributor_code,
                'product_id' => $product_id,
                'product_name' => $name,
                'product_unit' => $unit,
                'product_logo_uri' => $product_logo_uri[0],
                'qty' => $qty,
                'product_price' => $price,
                'total_price' => $product_total_price,
                'platform_os' => $decode['platform_os'],
                'platform_version' => $decode['platform_version'],
                'user_agent' => $user_agent,
                'client_ip' => $client_ip,
                'host' => $host,
                'status' => ORDER_DEFAULT_STATUS,
            );

            $email_params[$distributor_id]['status'] = !empty($statuses[ORDER_DEFAULT_STATUS]) ? $statuses[ORDER_DEFAULT_STATUS] : __('unknown');
            $email_params[$distributor_id]['items'][] = array(
                'name' => $name,
                'unit' => $unit,
                'qty' => $qty,
                'price' => $price,
                'total_price' => $product_total_price,
                'logo_uri' => $product_logo_uri[0],
            );

            $order_cache[] = array(
                'product_id' => $product_id,
                'product_name' => $name,
                'product_logo_uri' => $product_logo_uri[0],
                'qty' => $qty,
                'product_price' => $price,
                'product_unit' => $unit,
                'total_price' => $product_total_price,
            );

            $total_qty += $qty;
            $total_price += $qty * $price;

            $order_distributor_data[$distributor_id]['total_qty'] += $qty;
            $order_distributor_data [$distributor_id]['total_price'] += $qty * $price;

            if (empty($order_distributor_cache[$distributor_id])) {
                $order_distributor_cache[$distributor_id] = array();
            }
            $order_distributor_cache[$distributor_id][] = array(
                'product_id' => $product_id,
                'product_name' => $name,
                'product_logo_uri' => $product_logo_uri[0],
                'qty' => $qty,
                'product_price' => $price,
                'product_unit' => $unit,
                'total_price' => $product_total_price,
            );
            $order_distributor_data[$distributor_id]['cache_data'] = serialize($order_distributor_cache[$distributor_id]);

            $email_params[$distributor_id]['region_id'] = $decode['region_id'];
            $email_params[$distributor_id]['region_name'] = $decode['region_name'];
            $email_params[$distributor_id]['region_parent_id'] = $decode['region_parent_id'];
            $email_params[$distributor_id]['region_parent_name'] = $decode['region_parent_name'];
            $email_params[$distributor_id]['customer_name'] = $customer_data['name'];
            $email_params[$distributor_id]['customer_mobile'] = $customer_data['mobile'];
            $email_params[$distributor_id]['customer_mobile2'] = $customer_data['mobile2'];
            $email_params[$distributor_id]['customer_address'] = $customer_data['address'];
            $email_params[$distributor_id]['total_price'] = $total_price;
            $email_params[$distributor_id]['total_qty'] = $total_qty;
        }

        $order_data = array(
            'customer_code' => $customer_data['code'],
            'customer_id' => $customer_data['id'],
            'customer_name' => $customer_data['name'],
            'customer_mobile' => $customer_data['mobile'],
            'customer_mobile2' => $customer_data['mobile2'],
            'customer_address' => $customer_data['address'],
            'region_id' => $decode['region_id'],
            'region_name' => $decode['region_name'],
            'region_parent_id' => $decode['region_parent_id'],
            'region_parent_name' => $decode['region_parent_name'],
            'code' => $order_code,
            'no' => $total_order + 1,
            'total_qty' => $total_qty,
            'total_price' => $total_price,
            'notes' => $customer_data['address'],
            'platform_os' => $decode['platform_os'],
            'platform_version' => $decode['platform_version'],
            'user_agent' => $user_agent,
            'client_ip' => $client_ip,
            'host' => $host,
            'raw_data' => $data,
            'cache_data' => serialize($order_cache),
            'status' => ORDER_DEFAULT_STATUS,
        );

        $dataSource = $this->Order->getDataSource();
        $dataSource->begin();

        $this->Order->create();
        if (!$this->Order->save($order_data)) {
            $dataSource->rollback();
            $this->resError('ord#005');
        }
        $order_id = $this->Order->getLastInsertID();

        $order_distributor_ref = array();
        $order_distributor_count = 0;

        foreach ($order_distributor_data as $distributor_id => $v) {
            $order_distributor_count++;
            $v['order_id'] = $order_id;
            $v['no'] = $total_order_distributor + $order_distributor_count;
            $v['code'] = $customer_id . self::ORDER_BUNDLE_CODE_DELIMITER . $v['no'];
            $email_params[$distributor_id]['code'] = $v['code'];

            $this->OrdersDistributor->create();
            if (!$this->OrdersDistributor->save($v)) {
                $dataSource->rollback();
                $this->resError('ord#006');
            }
            $order_distributor_id = $this->OrdersDistributor->getLastInsertID();
            $order_distributor_ref[$distributor_id] = array(
                'id' => $order_distributor_id,
                'code' => $v['code'],
                'distributor_id' => $distributor_id,
            );
        }

        $this->parseOrderProduct($order_product_data, $order_id, $order_code, $order_distributor_ref);
        if (!$this->OrdersProduct->saveAll($order_product_data)) {
            $dataSource->rollback();
            $this->resError('ord#007');
        }

        // thực hiện update lại customer
        $customer_update_data = array(
            'id' => $customer_id,
            'total_order' => $total_order + 1,
            'total_order_distributor' => $total_order_distributor + $order_distributor_count,
            'total_order_pending' => $total_order_pending + 1,
            'total_order_distributor_pending' => $total_order_distributor_pending + $order_distributor_count,
        );
        if (!$this->Customer->save($customer_update_data)) {

            $dataSource->rollback();
            $this->resError('#ord008');
        }

        $dataSource->commit();

        // Thực hiện gửi email thông báo
//        $this->sendEmail($email_params);

        $res['data'] = array(
            'order_id' => $order_id,
            'order_code' => $order_code,
            'order_distributor_ref' => $order_distributor_ref,
            'total_order' => $total_order + 1,
            'total_order_distributor' => $total_order_distributor + $order_distributor_count,
            'total_order_pending' => $total_order + 1,
            'total_order_distributor_pending' => $total_order_distributor + $order_distributor_count,
        );
        $this->resSuccess($res);
    }

    protected function parseOrderProduct(&$order_product_data, $order_id, $order_code, $order_distributor_ref) {
        foreach ($order_product_data as $k => $v) {
            $distributor_id = $v['distributor_id'];
            $order_product_data[$k]['order_id'] = $order_id;
            $order_product_data[$k]['order_code'] = $order_code;
            $order_product_data[$k]['orders_distributor_id'] = $order_distributor_ref[$distributor_id]['id'];
            $order_product_data[$k]['orders_distributor_code'] = $order_distributor_ref[$distributor_id]['code'];
        }
    }

    protected function sendEmail($email_params) {
        if (empty($email_params)) {
            return true;
        }
        $settings = $this->Setting->find('list', array(
            'recursive' => -1,
            'conditions' => array(
                'key' => array(
                    'EMAIL_ADMIN',
                    'EMAIL_SUBJECT',
                    'EMAIL_LOGO',
                ),
            ),
            'fields' => array(
                'key', 'value',
            ),
        ));
        $email_admin = strlen($settings['EMAIL_ADMIN']) ? explode(',', $settings['EMAIL_ADMIN']) : array();
        $email_subject_pattern = $settings['EMAIL_SUBJECT'];

        foreach ($email_params as $v) {
            $v['logo_uri'] = $settings['EMAIL_LOGO'];
            $v['created'] = date('d-m-Y H:i:s');
            $email_contact = array_merge($email_admin, $v['email']);
            if (empty($email_contact)) {
                $this->logAnyFile("Không cần thực hiện gửi email do danh sách contact rỗng", $this->log_file_name);
                continue;
            }
            $email_subject = strtr($email_subject_pattern, array(
                '[MA_DON]' => $v['code'],
                '[VUNG_MIEN]' => $v['region_name'],
                '[THANH_PHO]' => $v['region_parent_name'],
            ));
            $email_template = 'invoice';

            $Email = new CakeEmail();
            $Email->config('default');
            $Email->template($email_template);
            $Email->emailFormat('html')
                    ->subject($email_subject)->from('cskh@ongas.vn')
                    ->to($email_contact);
            $Email->viewVars($v);
            try {
                $content = $Email->send();
                $this->logAnyFile(__('email "%s" được gửi tới "%s" thành công, nội dung:', $email_subject, implode(',', $email_contact)), $this->log_file_name);
                $this->logAnyFile($content, $this->log_file_name);
            } catch (Exception $ex) {
                $this->logAnyFile(__("Không gửi được email: %s, chi tiết:", $ex->getMessage()), $this->log_file_name);
                $this->logAnyFile($ex->getTraceAsString(), $this->log_file_name);

                return false;
            }
        }
    }

}
