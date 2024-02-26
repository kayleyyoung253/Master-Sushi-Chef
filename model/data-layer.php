<?php
/*
data-layer.php: data for menu
*/
require_once ('model/data-layer.php');
class menuData{

    static function getAppetizer(){
        return array('Gyoza','Edamame', 'Green beans', 'Sashimi', 'Ajitama', 'Miso soup');
    }

    static function getRolls(){
        return array('California roll','Spicy tuna roll', 'Seattle roll', 'Master roll', 'New york roll', 'Dragon roll');
    }

}