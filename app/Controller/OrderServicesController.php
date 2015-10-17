<?php

App::uses('ServiceAppController', 'Controller');

class OrderServicesController extends ServiceAppController {

    public $uses = array(
        'Order',
        'OrdersProduct',
        'Customer',
        'Product',
    );
    public $debug_mode = 3;

    public function create() {

        $data = $this->request->data('data');
        if (empty($data)) {

            $this->resError('#ord001');
        }

        $decode = json_decode($data, true);
        if (empty($decode)) {

            $this->resError('#ord002');
        }

        $customer_data = $decode['customer'];
        $customer_data['region_id'] = $decode['region_id'];
        $customer_data['platform_os'] = $decode['platform_os'];
        $customer_data['platform_version'] = $decode['platform_version'];

        // kiểm tra xem customer có đang bị khóa hay không?
        $customer = $this->Customer->getInfoByCode($customer_data['code']);
        if (!empty($customer) && $customer['Customer']['status'] != 2) {

            $this->resError('#ord003');
        }

        // nếu chưa tồn tại customer thì tạo mới
        if (empty($customer)) {

            $this->Customer->create();
            $this->Customer->save($customer_data);
            $customer_id = $this->Customer->getLastInsertID();
        }
        // nếu đã tồn tại rồi thì update
        else {

            $customer_id = $customer['Customer']['id'];
            $customer_data['id'] = $customer_id;
            $this->Customer->save($customer_data);
        }

        $cart_data = $decode['cart'];
        if (empty($cart_data) || !is_array($cart_data)) {

            $this->resError('#ord004');
        }

        $order_data = array();
        $total_qty = 0;
        $total_price = 0;
        foreach ($cart_data as $k => $v) {

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
            $order_data['OrdersProduct'][$k] = array(
                'bundle_id' => $product['Product']['bundle_id'],
                'product_id' => $product_id,
                'product_name' => $product['Product']['name'],
                'product_logo_uri' => $product_logo_uri[0],
                'qty' => $v['qty'],
                'product_price' => $product['Product']['price'],
            );

            $total_qty += $v['qty'];
            $total_price += $v['qty'] * $product['Product']['price'];
        }

        $order_code = uniqid();
        $order_data['Order'] = array(
            'customer_code' => $customer_data['code'],
            'customer_id' => $customer_data['id'],
            'region_id' => $decode['region_id'],
            'code' => $order_code,
            'total_qty' => $total_qty,
            'total_price' => $total_price,
            'notes' => $customer_data['address'],
            'platform_os' => $decode['platform_os'],
            'platform_version' => $decode['platform_version'],
            'raw_data' => $data,
        );

        // thực hiện lưu thông tin đơn hàng
        if ($this->Order->saveAll($order_data)) {

            $res['data'] = array(
                'code' => $order_code
            );
            $this->resSuccess($res);
        }

        $this->resError('ord#005');
    }

}
