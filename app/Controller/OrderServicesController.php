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

        $data = $this->request->data('order');
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
        }
        // nếu đã tồn tại rồi thì update
        else {

            $customer_id = $customer['Customer']['id'];
            $customer_data['id'] = $customer_id;
            $this->Customer->save($customer_data);
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
        $order_code = uniqid();

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
                    'bundle_id' => $bundle_id,
                    'order_code' => $order_code,
                    'code' => uniqid(),
                    'total_qty' => 0,
                    'total_price' => 0,
                    'notes' => $customer_data['address'],
                    'platform_os' => $decode['platform_os'],
                    'platform_version' => $decode['platform_version'],
                    'user_agent' => $user_agent,
                    'client_ip' => $client_ip,
                    'host' => $host,
                    'raw_data' => $data,
                );
                $order_bundle_cache[$bundle_id] = array();
            }

            $order_product_data[] = array(
                'customer_code' => $customer_data['code'],
                'customer_id' => $customer_data['id'],
                'region_id' => $decode['region_id'],
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
            'code' => $order_code,
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

        foreach ($order_bundle_data as $bundle_id => $v) {

            $v['order_id'] = $order_id;
            $this->OrdersBundle->create();
            if (!$this->OrdersBundle->save($v)) {

                $dataSource->rollback();
                $this->resError('ord#006');
            }
            $order_bundle_id = $this->OrdersBundle->getLastInsertID();
            $order_bundle_ref[$bundle_id] = array(
                'id' => $order_bundle_id,
                'code' => $v['code'],
            );
        }

        $this->parseOrderProduct($order_product_data, $order_id, $order_code, $order_bundle_ref);
        if (!$this->OrdersProduct->saveAll($order_product_data)) {

            $dataSource->rollback();
            $this->resError('ord#007');
        }

        $dataSource->commit();

        $res['data'] = array(
            'order_id' => $order_id,
            'order_code' => $order_code,
            'order_bundle_ref' => $order_bundle_ref,
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
