<?php

/**
 * the controller class for MasterSushi Chef
 *
 */

class Controller
{
    private $_f3; //Fat-free router

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        //echo "My Diner";

        // Display a view page
        $view = new Template();
        echo $view->render('views/homePage.html');
    }
    function order(){

        //display a view page
        $view = new Template();// template is a class from fat-free
        echo $view->render('views/order.html');
    }

}