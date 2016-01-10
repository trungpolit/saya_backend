<?php

App::uses('AppController', 'Controller');

class TestsController extends AppController {

    public $uses = array(
        'Region',
        'Category',
        'Product',
        'Notification',
    );

    public function regionCache() {

        $this->Region->cache();
        $this->render('empty');
    }

    public function categoryCache() {

        $this->Category->cache();
        $this->render('empty');
    }

    public function categoryProduct() {

        $this->Product->cache();
        $this->render('empty');
    }

    public function syncRegionNotificationGroup() {

        $this->Region->generateNotificationGroup();
        $this->render('empty');
    }

    public function notificationCache() {

        $this->Notification->cache();
        $this->render('empty');
    }

    public function makeOrderJson() {

        $this->autoRender = false;

        $region_id = $this->request->query('region_id');
        if (empty($region_id)) {

            $region_id = '3';
        }

        $region = $this->Region->find('first', array(
            'conditions' => array(
                'id' => $region_id,
            ),
        ));

        // lấy ra danh sách product tương ứng với $region_id
        $products = $this->Product->find('all', array(
            'recursive' => -1,
            'conditions' => array(
                'status' => 2,
                'region_id' => $region_id,
            ),
        ));
        if (empty($products)) {

            die(__('Have any product with region_id="%s"', $region_id));
        }

        $cart = array();
        foreach ($products as $pro) {

            $cart[] = array(
                'id' => $pro['Product']['id'],
                'qty' => rand(1, 3),
            );
        }

        $arr = array(
            'customer' => array(
                'code' => uniqid(),
                'name' => 'Test 1',
                'mobile' => '01689405616',
                'mobile2' => '',
                'address' => 'Hà Nội Phố',
            ),
            'region_id' => $region_id,
            'region_name' => $region['Region']['name'],
            'platform_os' => 'ANDROID',
            'platform_version' => '4.4.4',
            'cart' => $cart,
        );

        echo json_encode($arr);
    }

}
