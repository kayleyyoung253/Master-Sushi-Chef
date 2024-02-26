<?php
// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the autoload file
require_once ('vendor/autoload.php');

//Instantiate Fat-Free framework (f3)
$f3 = Base::instance();  //instance method
$con = new Controller($f3);

//Define a default route-invoking route method
$f3->route('GET /', function() {
    $GLOBALS['con']->home();
});


//Define a default route-invoking route method
$f3->route('GET /order', function() {
    $GLOBALS['con']->order();
});

//Define a default route to menu
$f3->route('GET /menu', function() {
    $GLOBALS['con']->menu();
});



//run Fat-Free
$f3->run();