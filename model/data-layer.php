<?php
/*
data-layer.php: data for menu
*/
require_once('model/data-layer.php');
require($_SERVER['DOCUMENT_ROOT'] . '/../MSCDB.php');

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


    function checkLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['username'])) {

                $username = $_POST['username'];
                // define the query
                $sql = "SELECT * FROM users WHERE username = :username";
                // prepare the statement
                $statement = $this->_dbh->prepare($sql);


                // execute
                $statement->execute();
                // process the results
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                if (isset($_POST['password'])) {

                    $passwordData = $_POST['password'];
                    // define the query
                    $sqlPass = "SELECT * FROM users WHERE password";
                    // prepare the statement
                    $statement = $this->_dbh->prepare($sqlPass);
                    // execute
                    $statement->execute();
                    // process the results
                    $resultPass = $statement->fetchAll(PDO::FETCH_ASSOC);

                    if ($sql == $result && $passwordData == $resultPass) {
                        echo 'All logged in';
                    } else{
                        echo $result . " " . $resultPass;
                    }


                }

            }
        }
    }

    static function getAppetizer()
    {   return array(
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
     //   return array('California roll', 'Spicy tuna roll', 'Seattle roll', 'Master roll', 'New york roll', 'Dragon roll');
    }

}