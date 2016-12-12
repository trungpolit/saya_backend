<?php

header('Content-type: text/html; charset=utf-8');
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
if (!defined('ROOT')) {
    //define('ROOT', dirname(dirname(dirname(__FILE__))));
    define('ROOT', dirname(dirname(__FILE__)));
}

if (!defined('APP_DIR')) {
    //define('APP_DIR', basename(dirname(dirname(__FILE__))));
    define('APP_DIR', basename(dirname(__FILE__)));
}

if (!defined('WEBROOT_DIR')) {
    //define('WEBROOT_DIR', basename(dirname(__FILE__)));
    define('WEBROOT_DIR', basename(__FILE__));
}
if (!defined('WWW_ROOT')) {
    //define('WWW_ROOT', dirname(__FILE__) . DS);
    define('WWW_ROOT', __FILE__ . DS);
}

// for built-in server
if (php_sapi_name() == 'cli-server') {
    if ($_SERVER['REQUEST_URI'] !== '/' && file_exists(WWW_ROOT . $_SERVER['REQUEST_URI'])) {
        return false;
    }
    $_SERVER['PHP_SELF'] = '/' . basename(__FILE__);
}

if (!defined('CAKE_CORE_INCLUDE_PATH')) {
    if (function_exists('ini_set')) {
        ini_set('include_path', ROOT . DS . 'lib' . PATH_SEPARATOR . ini_get('include_path'));
    }
    if (!include ('Cake' . DS . 'bootstrap.php')) {
        $failed = true;
    }
} else {
    if (!include (CAKE_CORE_INCLUDE_PATH . DS . 'Cake' . DS . 'bootstrap.php')) {
        $failed = true;
    }
}
if (!empty($failed)) {
    trigger_error("CakePHP core could not be found. Check the value of CAKE_CORE_INCLUDE_PATH in APP/webroot/index.php. It should point to the directory containing your " . DS . "cake core directory and your " . DS . "vendors root directory.", E_USER_ERROR);
}

App::uses('Dispatcher', 'Routing');
define('CRON_DISPATCHER', true);
if (!ini_get('register_argc_argv')) {
    ini_set('register_argc_argv', 1);
}
if (!isset($argc)) {
    $argc = $_SERVER['argc'];
}
if (!isset($argv)) {
    $argv = $_SERVER['argv'];
}
if ($argc > 1) {

    $Dispatcher = new Dispatcher();

    $command_params = array_slice($argv, 1);
    $action_url = implode('/', $command_params);

    $Dispatcher->dispatch(new CakeRequest($action_url), new CakeResponse(array('charset' => Configure::read('App.encoding'))));
}

