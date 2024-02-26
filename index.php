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
$f3->route('GET|POST /order', function($f3) {


    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Validate the data
        if (isset($_POST['appetizer'])) {
            $app = implode(", ", $_POST['appetizer']);
        } else {
            $app = "None selected";
        }
        if (isset($_POST['roll'])) {
            $roll = implode(", ", $_POST['roll']);
        } else {
            $roll = "None selected";
        }

        // Put the data in the session array
        $f3->set('SESSION.app', $app);
        $f3->set('SESSION.roll', $roll);

        // Redirect to summary route
        $f3->reroute('menu');
    }

    $GLOBALS['con']->order();
});

//Define a default route to menu
$f3->route('GET /menu', function() {
    $GLOBALS['con']->menu();
});



//run Fat-Free
$f3->run();