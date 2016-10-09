<?php

if (!defined("FULL_BASE_URL")) {
    define("FULL_BASE_URL", "http://cms.ongas.vn");
}

if (!defined("ORDER_DEFAULT_STATUS")) {
    define("ORDER_DEFAULT_STATUS", 2);
}

if (!defined("ORDER_LIMIT")) {
    define("ORDER_LIMIT", 5);
}

if (!defined("STATUS_PUBLIC")) {
    define("STATUS_PUBLIC", 2);
}

if (!defined("STATUS_PENDING")) {
    define("STATUS_PENDING", 2);
}

if (!defined("STATUS_SUCCESS")) {
    define("STATUS_SUCCESS", 1);
}

if (!defined("STATUS_FAIL")) {
    define("STATUS_FAIL", 0);
}

if (!defined("STATUS_BAD")) {
    define("STATUS_BAD", 3);
}

if (!defined("STATUS_PROCESSING")) {
    define("STATUS_PROCESSING", 4);
}

if (!defined("STATUS_BUY_BLACK")) {
    define("STATUS_BUY_BLACK", 0);
}

if (!defined("STATUS_BUY_BAD")) {
    define("STATUS_BUY_BAD", 1);
}

if (!defined("STATUS_BUY_GOOD")) {
    define("STATUS_BUY_GOOD", 2);
}

if (!defined("STATUS_ENABLE")) {
    define("STATUS_ENABLE", 1);
}

if (!defined("STATUS_DISABLE")) {
    define("STATUS_DISABLE", 0);
}

if (!defined("ADMIN_TYPE")) {
    define("ADMIN_TYPE", 'ADMIN');
}

if (!defined("MANAGER_TYPE")) {
    define("MANAGER_TYPE", 'MANAGER');
}

if (!defined("DAILY_REPORT_REFRESH")) {
    define("DAILY_REPORT_REFRESH", 180);
}

if (!defined("DISTRIBUTOR_TYPE")) {
    define("DISTRIBUTOR_TYPE", 'DISTRIBUTOR');
}

if (!defined("DISTRIBUTOR_ROLE_ID")) {
    define("DISTRIBUTOR_ROLE_ID", 2);
}

if (!defined("STATUS_NOT_SEND")) {
    define("STATUS_NOT_SEND", 2);
}

if (!defined("STATUS_SEND_SUCCESS")) {
    define("STATUS_SEND_SUCCESS", 1);
}

if (!defined("STATUS_SEND_FAIL")) {
    define("STATUS_SEND_FAIL", 0);
}

if (!defined("STATUS_SEND_EXCEPTION")) {
    define("STATUS_SEND_EXCEPTION", 3);
}

$config['saya'] = array(
    'App' => array(
        'cache_path' => 'webroot/cache/',
        'status' => array(
            -1 => __('status_rejected'),
            0 => __('status_hidden'),
            1 => __('status_wait_review'),
            2 => __('status_approved'),
        ),
        'name' => 'onGas',
        'max_file_size_upload' => 5 * 1000 * 1000,
        'data_file_root' => 'data_files/',
        'video_types' => array(
            'mp4',
            'ogg',
        ),
        'slogan' => 'kết nối niềm tin',
    ),
    'Category' => array(
        'module_name' => 'categories',
        'cache_path' => 'webroot/cache/categories/',
    ),
    'Product' => array(
        'module_name' => 'products',
        'cache_path' => 'webroot/cache/products/',
    ),
    'Settings' => array(
        'editor_keys' => array(
            'EMPTY_PRODUCT_IN_REGION',
            'ADD_CART_THAN_MAX',
            'DELETE_CART',
            'REMOVE_ITEM_IN_CART',
            'NOT_FULLFILL_FORM',
            'OFFLINE_NETWORK',
            'CHECKOUT_SUCCESS',
            'CHECKOUT_ERROR',
            'SYSTEM_EXCEPTION',
            'EMPTY_CART',
            'ABOUT_US',
            'FEEDBACK_SUCCESS',
            'FEEDBACK_ERROR',
            'CLIENT_VERSION_MESSAGE',
            'CATEGORY_WELCOME_CONTENT',
            'EMAIL_ADDRESS',
            'EMAIL_CONTACT',
        ),
    ),
    'Setting' => array(
        'cache_path' => 'webroot/cache/',
    ),
    'Notification' => array(
        'cache_path' => 'webroot/cache/notifications/',
        'period_cache' => 1, // đơn vị là tháng
    ),
    'Order' => array(
        'status' => array(
            STATUS_FAIL => __('Hủy'),
            STATUS_SUCCESS => __('Thành công'),
            STATUS_PENDING => __('Chờ xử lý'),
            STATUS_PROCESSING => __('Đang xử lý'),
            STATUS_BAD => __('Giả mạo'),
        ),
    ),
    'Customer' => array(
        'status' => array(
            STATUS_BUY_BLACK => __('Chặn mua hàng'),
            STATUS_BUY_BAD => __('Mua giả mạo'),
            STATUS_BUY_GOOD => __('Cho phép mua'),
        ),
    ),
    'Ads' => array(
        'status' => array(
            STATUS_DISABLE => __('Tắt'),
            STATUS_ENABLE => __('Bật'),
        ),
    ),
    'Platform' => array(
        'os' => array(
            'Android' => 'Android',
            'iOS' => 'iOS',
        ),
    ),
);




