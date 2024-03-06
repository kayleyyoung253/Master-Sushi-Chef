<?php
/*
data-layer.php: data for menu
*/
require_once ('model/data-layer.php');
require($_SERVER['DOCUMENT_ROOT'].'/../MSCDB.php');

class menuData{
    private $_dbh; // database handle

    /**
     * datalayer constructor
     */

    function __construct()
    {
        try{
            // instantiate a PDO database connection object
            $this-> _dbh = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
        }
        catch (PDOException $e){
            echo  $e->getMessage(); # temporary
        }
    }


    static function getAppetizer(){
        return array('Gyoza','Edamame', 'Green beans', 'Sashimi', 'Ajitama', 'Miso soup');
    }

    static function getRolls(){
        return array('California roll','Spicy tuna roll', 'Seattle roll', 'Master roll', 'New york roll', 'Dragon roll');
    }

}