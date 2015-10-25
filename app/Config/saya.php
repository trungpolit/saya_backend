<?php

$config['saya'] = array(
    'App' => array(
        'cache_path' => 'webroot/cache/',
        'status' => array(
            -1 => __('status_rejected'),
            0 => __('status_hidden'),
            1 => __('status_wait_review'),
            2 => __('status_approved'),
        ),
        'name' => 'SAYA',
        'max_file_size_upload' => 5 * 1000 * 1000,
        'data_file_root' => 'data_files/',
        'video_types' => array(
            'mp4',
            'ogg',
        ),
    ),
    'Category' => array(
        'module_name' => 'categories',
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
        ),
    ),
    'Setting' => array(
        'cache_path' => 'webroot/cache/',
    ),
    'Notification' => array(
        'cache_path' => 'webroot/cache/notifications/',
        'period_cache' => 1, // đơn vị là tháng
    ),
);
