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
        'data_file_root' => 'data_files',
    ),
    'Category' => array(
        'module_name' => 'categories',
    ),
);
