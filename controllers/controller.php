<?php

/**
 * the controller class for MasterSushi Chef
 *
 */
require_once ('model/data-layer.php');
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


        $this->_f3->set('appetizer', menuData::getAppetizer());
        $this->_f3->set('roll', menuData::getRolls());
        //display a view page
        $view = new Template();// template is a class from fat-free
        echo $view->render('views/order.html');
    }

    function checkout()
    {
        //display a view page
        $view = new Template();// template is a class from fat-free
        echo $view->render('views/checkout.html');
    }


    function menu()
    {
        //display a view page
        $view = new Template();// template is a class from fat-free
        echo $view->render('views/menu.html');
    }

}