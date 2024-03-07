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


$price = array(
    'Gyoza' => 5.99,
    'Edamame' => 3.99,
    'Green beans' => 3.99,
    'Sashimi' => 24.99,
    'Ajitama' => 3.99,
    'Miso soup' => 4.99,
    'California roll' => 8.99,
    'Spicy tuna roll' => 8.99,
    'Seattle roll' => 11.99,
    'New york roll' => 13.99,
    'Dragon roll' => 12.99
);

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

        $totalPrice = 0;
        // calculating appetizer
        if(isset($_POST['appetizer'])){
            foreach ($_POST['appetizer'] as $appetizer){
                if (isset($price[$appetizer])){
                    $totalPrice = $totalPrice + $price[$appetizer];
                }
            }
        }
        // calculating rolls
        if(isset($_POST['roll'])){
            foreach ($_POST['roll'] as $selectedRoll){
                if(isset($price[$selectedRoll])) {
                   echo $totalPrice = $totalPrice + $price[$selectedRoll];
                }
            }
        }


        // Put the data in the session array
        $f3->set('SESSION.app', $app);
        $f3->set('SESSION.roll', $roll);
        $f3->set('SESSION.totalPrice', $totalPrice);

        // Redirect to summary route
        $f3->reroute('checkout');
    }

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
$f3->route('GET /menu', function() {
    $GLOBALS['con']->menu();
});



//run Fat-Free
$f3->run();