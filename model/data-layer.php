<?php
/*
data-layer.php: data for menu
*/
require_once('model/data-layer.php');
require($_SERVER['DOCUMENT_ROOT'] . '/../MSCDB.php');
require_once ('classes/user.php');

class menuData
{
    private $_dbh; // database handle

    /**
     * datalayer constructor
     */

    function __construct()
    {
        try {
            // instantiate a PDO database connection object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        } catch (PDOException $e) {
            echo $e->getMessage(); # temporary
        }
    }


    /**
     *check if a member has logged in
     * @param password $passwordData
     *
     */
    function checkLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['username']) && isset($_POST['password'])) {

                $usernameData = $_POST['username'];
                $passwordData = $_POST['password'];

                // define the query
                $sql = "SELECT * FROM users WHERE username = :username AND password = :password";

                // prepare the statement
                $statement = $this->_dbh->prepare($sql);

                //bind the parameter
                $statement->bindParam(':username', $usernameData);
                $statement->bindParam(':password', $passwordData);

                // execute
                $statement->execute();
                // process the results
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                if ($user['password'] == $passwordData && $user['username'] == $usernameData) {
                        $userObj = new user($user['id'], $usernameData, $passwordData, $user['fname'], $user['lname'], $user['email'], $user['phone'], $user['points_earned'], $user['points_used']);
                    return $userObj;

                } else {
                    echo $user;
                }
            } else {
                echo "Username or Password not found";
            }
        }
        return 0;
    }


    function createAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['username']) && isset($_POST['password'])) {

                $usernameData = $_POST['username'];
                $passwordData = $_POST['password'];
                $fnameData = $_POST['fname'];
                $lnameData = $_POST['lname'];
                $emailData = $_POST['email'];
                $phoneData = $_POST['phone'];
                $points_earnedData = 0;
                $points_usedData = 0;


                // define the query
                $sql = "INSERT INTO users (username, password, fname, lname, email, phone) VALUES (:username, :password, :fname, :lname, :email, :phone, :points_earned, :points_used)";

                // prepare the statement
                $statement = $this->_dbh->prepare($sql);

                // Bind parameters
                $statement->bindParam(':username', $usernameData);
                $statement->bindParam(':password', $passwordData);
                $statement->bindParam(':fname', $fnameData);
                $statement->bindParam(':lname', $lnameData);
                $statement->bindParam(':email', $emailData);
                $statement->bindParam(':phone', $phoneData);
                $statement->bindParam(':points_earned', $points_earnedData);
                $statement->bindParam(':points_used', $points_usedData);

                // Execute the statement
                $statement->execute();

            }
        }
    }


    public function updatePointsBalance($user_id, $points_earned)
    {
        // Update the points balance for the specified user ID in the database
        $sql = "UPDATE users SET points = points + :points_earned WHERE id = :user_id";
        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':points_earned', $points_earned);
        $statement->bindParam(':user_id', $user_id);
        $statement->execute();
    }

    function saveOrder($orders, $user_id){

        // define the query
        $sql = "INSERT INTO orders (user_id, rolls, app, totalPrice) VALUES (:user_id, :rolls, :app, :totalPrice)";

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Bind the parameters
        $statement->bindParam(':user_id',$user_id);
        $statement->bindParam(':rolls',$orders->getRolls());
        $statement->bindParam(':app',$orders->getApp());
        $statement->bindParam(':totalPrice',$orders->getTotalPrice());

        // Execute the statement
        $statement->execute();

        return $statement;
    }

    function loadOrders($user_id) {
        $sql = "SELECT * FROM orders WHERE user_id = :id";

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // bind the parameter
        $statement->bindParam(':id', $user_id);

        // execute
        $statement->execute();
        // process the results
        $orders = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $orders;
    }

    /**
     * @return array[] of appetizer values
     */
    static function getAppetizer()
    {
        return array(
            array(
                'appname' => 'Gyoza',
                'image' => 'Gyoza.jpeg',
                'price' => 7.99,
                'description' => 'Pan-fried Japanese dumplings filled with pork and vegetables.'
            ),
            array(
                'appname' => 'Edamame',
                'image' => 'edamame.jpeg',
                'price' => 4.99,
                'description' => 'Steamed young soybeans sprinkled with sea salt.'
            ),
            array(
                'appname' => 'Green beans',
                'image' => 'greenbean.jpeg',
                'price' => 6.99,
                'description' => 'Blanched green beans served with a savory sesame dressing.'
            ),
            array(
                'appname' => 'Sashimi',
                'image' => 'sashimi.jpeg',
                'price' => 12.99,
                'description' => 'Assorted slices of fresh raw fish served with soy sauce and wasabi.'
            ),
            array(
                'appname' => 'Ajitama',
                'image' => 'ajitama.jpeg',
                'price' => 3.99,
                'description' => 'Seasoned soft-boiled egg marinated in soy sauce and mirin.'
            ),
            array(
                'appname' => 'Miso soup',
                'image' => 'miso.jpeg',
                'price' => 4.99,
                'description' => 'Traditional Japanese soup made with miso paste, tofu, seaweed, and green onions.'
            )
        );
    }

    /**
     * @return array[] of roll values
     */
    static function getRolls()
    {
        return array(
            array(
                'name' => 'California roll',
                'image' => 'Cali.jpeg',
                'price' => 8.99,
                'description' => 'Fresh crab meat, cream cheese, and avocado, wrapped in sushi rice and seaweed.'
            ),
            array(
                'name' => 'Spicy tuna roll',
                'image' => 'SpicyTuna.jpeg',
                'price' => 10.99,
                'description' => 'Tuna mixed with spicy mayo, cucumber, and scallions, wrapped in sushi rice and seaweed.'
            ),
            array(
                'name' => 'Seattle roll',
                'image' => 'Seattle.jpeg',
                'price' => 9.99,
                'description' => 'Salmon, cream cheese, and cucumber, rolled in sushi rice and seaweed.'
            ),
            array(
                'name' => 'Master roll',
                'image' => 'MasterRoll.jpeg',
                'price' => 12.99,
                'description' => 'A signature roll with a blend of fresh crab, tobiko, and avocado, topped with eel and eel sauce.'
            ),
            array(
                'name' => 'New york roll',
                'image' => 'NewYork.jpeg',
                'price' => 11.99,
                'description' => 'cream cheese and cucumber, topped with salmon.'
            ),
            array(
                'name' => 'Dragon roll',
                'image' => 'dragonroll.jpg',
                'price' => 13.99,
                'description' => 'Shrimp, tobiko, and cucumber, topped with salmon, onion and garlic sauce.'
            )
        );

    }

}