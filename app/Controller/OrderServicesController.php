<?php

App::uses('ServiceAppController', 'Controller');

class OrderServicesController extends ServiceAppController {

    public $uses = array(
        'Order',
        'OrdersProduct',
        'OrdersBundle',
        'Customer',
        'Product',
    );
    public $debug_mode = 3;

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

        // trích xuất thông tin liên quan tới customer
        $user_agent = $this->request->header('User-Agent');
        $host = $this->request->host();
        $client_ip = $this->request->clientIp();

        $customer_data = $decode['customer'];
        $customer_data['region_id'] = $decode['region_id'];
        $customer_data['region_name'] = $decode['region_name'];
        $customer_data['platform_os'] = $decode['platform_os'];
        $customer_data['platform_version'] = $decode['platform_version'];
        $customer_data['user_agent'] = $user_agent;
        $customer_data['client_ip'] = $client_ip;
        $customer_data['host'] = $host;

        // kiểm tra xem customer có đang bị khóa hay không?
        $customer = $this->Customer->getInfoByCode($customer_data['code']);
        // nếu customer có trạng thái là -1: khóa, thì không cho tạo ra đơn hàng
        if (!empty($customer) && $customer['Customer']['status'] == -1) {

            $this->resError('#ord003');
        }

        // nếu chưa tồn tại customer thì tạo mới
        if (empty($customer)) {

            $this->Customer->create();
            $this->Customer->save($customer_data);
            $customer_id = $this->Customer->getLastInsertID();
            $customer_data['id'] = $customer_id;

            $total_order = $total_order_bundle = 0;
            $total_order_pending = $total_order_bundle_pending = 0;
        }
        // nếu đã tồn tại rồi thì update
        else {

            $customer_id = $customer['Customer']['id'];
            $customer_data['id'] = $customer_id;
            $this->Customer->save($customer_data);

            $total_order = !empty($customer['Customer']['total_order']) ?
                    $customer['Customer']['total_order'] : 0;
            $total_order_bundle = !empty($customer['Customer']['total_order_bundle']) ?
                    $customer['Customer']['total_order_bundle'] : 0;
            $total_order_pending = !empty($customer['Customer']['total_order_pending']) ?
                    $customer['Customer']['total_order_pending'] : 0;
            $total_order_bundle_pending = !empty($customer['Customer']['total_order_bundle_pending']) ?
                    $customer['Customer']['total_order_bundle_pending'] : 0;
        }

        // lấy ra thông tin trong giỏ hàng
        $cart_data = $decode['cart'];
        if (empty($cart_data) || !is_array($cart_data)) {

            $this->resError('#ord004');
        }

        $order_bundle_data = $order_product_data = array();
        $order_bundle_cache = array();
        $total_qty = 0;
        $total_price = 0;

        $order_no = $total_order + 1;
        $order_code = $customer_id . '_' . $order_no;

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
            $bundle_id = $product['Product']['bundle_id'];
            $price = $product['Product']['price'];
            $name = $product['Product']['name'];

            // nếu chưa tồn tại dữ liệu cho $order_bundle_data thì khởi tạo
            if (empty($order_bundle_data[$bundle_id])) {

                $order_bundle_data[$bundle_id] = array(
                    'customer_code' => $customer_data['code'],
                    'customer_id' => $customer_data['id'],
                    'region_id' => $decode['region_id'],
                    'region_name' => $decode['region_name'],
                    'bundle_id' => $bundle_id,
                    'order_code' => $order_code,
                    'total_qty' => 0,
                    'total_price' => 0,
                    'notes' => $customer_data['address'],
                    'platform_os' => $decode['platform_os'],
                    'platform_version' => $decode['platform_version'],
                    'user_agent' => $user_agent,
                    'client_ip' => $client_ip,
                    'host' => $host,
                    'raw_data' => $data,
                    'status' => ORDER_DEFAULT_STATUS,
                );
                $order_bundle_cache[$bundle_id] = array();
            }

            $order_product_data[] = array(
                'customer_code' => $customer_data['code'],
                'customer_id' => $customer_data['id'],
                'region_id' => $decode['region_id'],
                'region_name' => $decode['region_name'],
                'bundle_id' => $bundle_id,
                'product_id' => $product_id,
                'product_name' => $name,
                'product_logo_uri' => $product_logo_uri[0],
                'qty' => $v['qty'],
                'product_price' => $price,
                'platform_os' => $decode['platform_os'],
                'platform_version' => $decode['platform_version'],
                'user_agent' => $user_agent,
                'client_ip' => $client_ip,
                'host' => $host,
            );

            $order_cache[] = array(
                'product_id' => $product_id,
                'product_name' => $name,
                'product_logo_uri' => $product_logo_uri[0],
                'qty' => $v['qty'],
                'product_price' => $price,
            );

            $total_qty += $v['qty'];
            $total_price += $v['qty'] * $price;

            $order_bundle_data[$bundle_id]['total_qty'] += $v['qty'];
            $order_bundle_data [$bundle_id]['total_price'] += $v['qty'] * $price;
            $order_bundle_cache[$bundle_id] = array(
                'product_id' => $product_id,
                'product_name' => $name,
                'product_logo_uri' => $product_logo_uri[0],
                'qty' => $v['qty'],
                'product_price' => $price,
            );
            $order_bundle_data[$bundle_id]['cache_data'] = serialize(array_values($order_bundle_cache));
        }

        $order_data = array(
            'customer_code' => $customer_data['code'],
            'customer_id' => $customer_data['id'],
            'region_id' => $decode['region_id'],
            'region_name' => $decode['region_name'],
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

        $order_bundle_ref = array();
        $order_bundle_count = 0;

        foreach ($order_bundle_data as $bundle_id => $v) {

            $order_bundle_count++;

            $v['order_id'] = $order_id;
            $v['no'] = $total_order_bundle + $order_bundle_count;
            $v['code'] = $customer_id . '_' . $v['no'];

            $this->OrdersBundle->create();
            if (!$this->OrdersBundle->save($v)) {

                $dataSource->rollback();
                $this->resError('ord#006');
            }
            $order_bundle_id = $this->OrdersBundle->getLastInsertID();
            $order_bundle_ref[$bundle_id] = array(
                'id' => $order_bundle_id,
                'code' => $v['code'],
                'bundle_id' => $bundle_id,
            );
        }

        $this->parseOrderProduct($order_product_data, $order_id, $order_code, $order_bundle_ref);
        if (!$this->OrdersProduct->saveAll($order_product_data)) {

            $dataSource->rollback();
            $this->resError('ord#007');
        }

        // thực hiện update lại customer
        $customer_update_data = array(
            'id' => $customer_id,
            'total_order' => $total_order + 1,
            'total_order_bundle' => $total_order_bundle + $order_bundle_count,
            'total_order_pending' => $total_order_pending + 1,
            'total_order_bundle_pending' => $total_order_bundle_pending + $order_bundle_count,
        );
        if (!$this->Customer->save($customer_update_data)) {

            $dataSource->rollback();
            $this->resError('#ord008');
        }

        $dataSource->commit();

        $res['data'] = array(
            'order_id' => $order_id,
            'order_code' => $order_code,
            'order_bundle_ref' => $order_bundle_ref,
            'total_order' => $total_order + 1,
            'total_order_bundle' => $total_order_bundle + $order_bundle_count,
        );
        $this->resSuccess($res);
    }

    protected function parseOrderProduct(&$order_product_data, $order_id, $order_code, $order_bundle_ref) {

        foreach ($order_product_data as $k => $v) {

            $bundle_id = $v['bundle_id'];

            $order_product_data[$k]['order_id'] = $order_id;
            $order_product_data[$k]['order_code'] = $order_code;
            $order_product_data[$k]['orders_bundle_id'] = $order_bundle_ref[$bundle_id]['id'];
            $order_product_data[$k]['orders_bundle_code'] = $order_bundle_ref[$bundle_id]['code'];
        }
    }

}
