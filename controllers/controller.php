<?php

/**
 * the controller class for MasterSushi Chef
 *
 */
require_once('model/data-layer.php');
require_once('classes/order.php');

class Controller
{
    private $_f3; //Fat-free router

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        // Display a view page
        $view = new Template();
        echo $view->render('views/homePage.html');
    }

    function order()
    {
        $user = $this->_f3->get('SESSION.user');
        if ($user != null) {
            echo "Logged in user";
        } else {
            echo "Not logged in";
        }
        // If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $selectedRolls = $this->_f3->get('POST.roll');
            $selectedApps = $this->_f3->get('POST.appetizer');
            $totalPrice = 0;

            // Validate the data
            if (isset($_POST['appetizer'])) {
                $app = implode(", ", $_POST['appetizer']);
                $appPrices = menuData::getAppetizer();
                // Iterate through selected rolls
                foreach ($selectedApps as $selectedApp) {
                    // Find the selected roll in the rolls data
                    foreach ($appPrices as $appPrice) {
                        if ($selectedApp === $appPrice['appname']) {
                            // Add the price of the selected roll to the total balance
                            $totalPrice += $appPrice['price'];
                        }
                    }

                }
            } else {
                $app = "None selected";
            }
            if (isset($_POST['roll'])) {
                $rolls = implode(", ", $_POST['roll']);
                $rollprices = menuData::getRolls();
                // Iterate through selected rolls
                foreach ($selectedRolls as $selectedRoll) {
                    // Find the selected roll in the rolls data
                    foreach ($rollprices as $rollprice) {
                        if ($selectedRoll === $rollprice['name']) {
                            // Add the price of the selected roll to the total balance
                            $totalPrice += $rollprice['price'];
                        }
                    }
                }
            } else {
                $rolls = "None selected";
            }


            // Put the data in the session array
            $this->_f3->set('SESSION.app', $app);
            $this->_f3->set('SESSION.roll', $rolls);
            $this->_f3->set('SESSION.totalPrice', $totalPrice);

            $orders = new Orders($rolls, $app, $totalPrice);
            // Put the object in the session array
            $this->_f3->set('SESSION.orders', $orders);
            $menuData = new MenuData;
            $menuData->saveOrder($this->_f3->get('SESSION.orders'), $user->getId());
            // Redirect to summary route
            $this->_f3->reroute('checkout');
        }

        $this->_f3->set('appetizer', menuData::getAppetizer());
        $this->_f3->set('roll', menuData::getRolls());
        //display a view page
        $view = new Template();// template is a class from fat-free
        echo $view->render('views/order.html');
    }

    function makeAccount()
    {
//        if($_SERVER['REQUEST_METHOD'] == 'POST') {
//            $this->_f3->reroute('login');
//        }
        $menuData = new MenuData;
        $menuData->createAccount();
        //display a view page
        $view = new Template();// template is a class from fat-free
        echo $view->render('views/makeAccount.html');
    }

    function checkout()
    {
        $user = $this->_f3->get('SESSION.user');
        if ($user != null) {
            echo "Logged in user";
        } else {
            echo "Not logged in";
        }

        if ($user != null) {
            // param i
            $menuData = new MenuData();
            if ($user instanceof user) {
                $orders = $menuData->loadOrders($user->getId());
                // Process the result array
                foreach ($orders as $row) {
                    // Access individual columns using array keys
                    echo "Order ID: " . $row['order_id'] . " Rolls: " . $row['rolls']
                        . " Apps: " . $row['apps'] . " Total: $" . $row['totalPrice'] . "<br>";
                }
            }
        }
        //display a view page
        $view = new Template();// template is a class from fat-free
        echo $view->render('views/checkout.html');

    }

    function login()
    {
        $menuData = new MenuData;
        $user = $menuData->checkLogin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($user instanceof user) {
                $this->_f3->set('SESSION.user', $user);
                echo "Logged in";
            } else {
                echo "Login error";
            }
        }

        //display a view page
        $view = new Template();// template is a class from fat-free
        echo $view->render('views/login.html');
    }



    function rewards()
    {

        $user = $this->_f3->get('SESSION.user');
        if ($user != null) {
            // param
            $menuData = new MenuData();
            if ($user instanceof user) {
                $orders = $menuData->loadOrders($user->getId());
                $this->_f3->set('SESSION.userOrders', $orders);
            }
        }
        //display a view page
        $view = new Template();// template is a class from fat-free
        echo $view->render('views/rewards.html');
    }


    function menu()
    {
        $this->_f3->set('appetizer', menuData::getAppetizer());
        $this->_f3->set('roll', menuData::getRolls());
        //display a view page
        $view = new Template();// template is a class from fat-free
        echo $view->render('views/menu.html');
    }

}