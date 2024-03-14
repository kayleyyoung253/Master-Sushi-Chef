<?php
/**
* index.php: routes for master-sushi chef
* @authors Kayley Young, Levi Miller
*/
// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the autoload file
require_once ('vendor/autoload.php');

//Instantiate Fat-Free framework (f3)
$f3 = Base::instance();  //instance method
$con = new Controller($f3);
$menuData = new MenuData();


//Define a default route-invoking route method to home
$f3->route('GET /', function() {
    $GLOBALS['con']->home();
});


//Define a route method to order page
$f3->route('GET|POST /order', function($f3) {
    $GLOBALS['con']->order();
});

//Define a default route to menu
$f3->route('GET|POST /checkout', function($f3) {
    $GLOBALS['con']->checkout();
});

//Define a default route to login
$f3->route('GET|POST /login', function($f3) {
    $GLOBALS['con']->login();
});

//Define a default route to orderHistory
$f3->route('GET /orderHistory', function($f3) {
    $GLOBALS['con']->orderHistory();
});


//Define a default route to makeanaccount
$f3->route('GET|POST /makeAnAccount', function() {
    $GLOBALS['con']->makeAccount();
});
//define a default route to confirmation
$f3->route('GET /confirmation', function(){
    $GLOBALS['con']->confirmation();
});

//Define a default route to menu
$f3->route('GET /menu', function() {
    $GLOBALS['con']->menu();
});



//run Fat-Free
$f3->run();