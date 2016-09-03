<?php

App::uses('AppController', 'Controller');
App::import('Vendor', 'push', array('file' => 'Push/autoload.php'));

use Genkgo\Push\Gateway;
use Genkgo\Push\Sender\GoogleGcmSender;
use Genkgo\Push\Sender\AppleApnSender;
use Genkgo\Push\Sender\WindowsSender;

class TestsController extends AppController {

    public $uses = array(
        'Region',
        'Category',
        'Product',
        'Notification',
        'Order',
        'OrdersBundle',
        'Customer',
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

    public function orderCache() {

        $this->Order->cache();
        $this->render('empty');
    }

    public function ordersBundleCache() {

        $this->OrdersBundle->cache();
        $this->render('empty');
    }

    public function customerCache() {

        $this->Customer->cache();
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

    public function push() {

        // construct the gateway, using the different senders
        $gateway = new Gateway([
            new GoogleGcmSender('AIzaSyDX_htow84_98lTRxs6BVHJSDwmPOrjutY'),
            new WindowsSender()
        ]);

        // below message will automatically go to their own specific sender
        $gateway->send(new Message(new Body('message content')), new AndroidDeviceRecipient('token'));
    }

}
