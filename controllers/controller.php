<?php
session_start();
/**
 * the controller class for MasterSushi Chef
 *
 */
require_once('model/data-layer.php');
require_once('model/Validate.php');
require_once('classes/order.php');
require_once ('classes/user_updates.php');

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
            $this->_f3->set('SESSION.totalPrice', $totalPrice);

            if ($user != null) {
                $menuData = new MenuData;
                $menuData->saveOrder($this->_f3->get('SESSION.orders'), $user->getId());

            }
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
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
          $email = "";
          $phone = "";
          $fname = "";
          $lname = "";
          $username =  $_POST['username'];
          $password = $_POST['password'];
          $menuData = new MenuData;

          // Validate the data
          //first name
          if (Validate::validName($_POST['fname'])) {
              $fname = $_POST['fname'];
          }
          else{
              $this->_f3->set('errors["fname"]', "Invalid name");
          }
          //last name
          if (Validate::validName($_POST['lname'])) {
              $lname = $_POST['lname'];
          }
          else{
              $this->_f3->set('errors["lname"]', "Invalid name");
          }
          //email
          if (Validate::validEmail($_POST['email'])) {
              $email = $_POST['email'];
          }
          else{
              $this->_f3->set('errors["email"]', "Invalid Email");
          }
          //phone number
          if (Validate::validPhone($_POST['phone'])) {
              $phone = $_POST['phone'];
          }
          else{
              $this->_f3->set('errors["phone"]', "Invalid number");
          }
            if(!$menuData->checkUsername()){
                $this->_f3->set('errors["username]', "Username already in use");
            }


          if (empty($this->_f3->get('errors'))) {
              $menuData = new MenuData;
              $menuData->createAccount();


              if(isset ($_POST['mailing'])){
                  $updates = $_POST['mailing'];
                  $userUpdated = new user_updates($updates);
                  $user = new User($username, $password, $fname, $lname, $email, $phone);

                  $user->setAdditionalData($userUpdated);

                  $this->_f3->set('SESSION.user', $user);
              } else{
                  $user = new User($username, $password, $fname, $lname, $email, $phone);
                  $this->_f3->set('SESSION.user', $user);
              }
              if (isset($_SESSION['user'])) {
                  session_destroy();
                  $_SESSION['user'] = null; // Reset user session
                  $this->_f3->reroute('login'); //Redirect to login page
                  exit;
              }

          }
      }



        //display a view page
        $view = new Template();// template is a class from fat-free
        echo $view->render('views/makeAccount.html');
    }


    function login()
    {
        $this->_f3->set('user', $_SESSION['user']);
       // $user = $this->_f3->get('SESSION.user');
       // var_dump($_SESSION);
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle logout first
            if (isset($_POST['logout'])) {
                // Check if the session is set before destroying it
                if (isset($_SESSION['user'])) {
                    session_destroy();
                    $_SESSION['user'] = null; // Reset user session
                    $this->_f3->reroute('login'); //Redirect to login page
                    exit;
                }
            } else {
                // Handle login
                if (!empty($_POST['username']) && !empty($_POST['password'])) {
                    $menuData = new MenuData;
                    $user = $menuData->checkLogin();
                    if ($user instanceof user) {
                        // Fetch updates status
                        $userId = $user->getId(); // Assuming getId() retrieves the user ID
                        $updatesEnabled = $menuData->getUserUpdates($userId);

                        // Set updates status for the user object
                        $user->setUpdatesStatus($updatesEnabled);

                        $_SESSION['user'] = $user;
                        $this->_f3->reroute('login'); //Redirect to dashboard or desired page after login
                    }
                    else {
                        $this->_f3->set('errors["login"]', "Invalid username or password");
                    }
                } else {
                    $this->_f3->set('errors["login"]', "Username and password are required");
                }
            }

        }
        var_dump($_SESSION);

        //display a view page
        $view = new Template();// template is a class from fat-free
        echo $view->render('views/login.html');
    }



    function orderHistory()
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
    function checkout()
    {
        $user = $this->_f3->get('SESSION.user');
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->_f3->reroute('confirmation');
        }

        //display a view page
        $view = new Template();// template is a class from fat-free
        echo $view->render('views/checkout.html');

    }
    function confirmation()
    {
        //display a view page
        $view = new Template();// template is a class from fat-free
        echo $view->render('views/confirmation.html');
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
