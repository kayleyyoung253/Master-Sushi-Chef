<?php
// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the autoload file
require_once ('vendor/autoload.php');

//Instantiate Fat-Free framework (f3)
$f3 = Base::instance();  //instance method
$con = new Controller($f3);
$menuData = new MenuData();



//Define a default route-invoking route method
$f3->route('GET /', function() {
    $GLOBALS['con']->home();
});


//Define a default route-invoking route method
$f3->route('GET|POST /order', function($f3) {
    $GLOBALS['con']->order();
});

//Define a default route to menu
$f3->route('GET /checkout', function() {
    $GLOBALS['con']->checkout();
});

//Define a default route to menu
$f3->route('GET|POST /login', function() {
    $GLOBALS['con']->login();
});

//Define a default route to menu
$f3->route('GET /rewards', function() {
    $GLOBALS['con']->rewards();
});


//Define a default route to menu
$f3->route('GET|POST /makeAnAccount', function() {
    $GLOBALS['con']->makeAccount();
});

//Define a default route to menu
$f3->route('GET /menu', function() {
    $GLOBALS['con']->menu();
});



//run Fat-Free
$f3->run();