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
    {
        return array('Gyoza', 'Edamame', 'Green beans', 'Sashimi', 'Ajitama', 'Miso soup');
    }

    static function getRolls()
    {
        return array('California roll', 'Spicy tuna roll', 'Seattle roll', 'Master roll', 'New york roll', 'Dragon roll');
    }

}