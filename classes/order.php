<?php
class orders
{

    private $_rolls;

    private $_app;

    private $_totalPrice;

    /**
     * @param $rolls
     * @param $app
     * @param $totalPrice
     */
    public function __construct($rolls, $app, $totalPrice)
    {
        $this->_rolls = $rolls;
        $this->_app = $app;
        $this->_totalPrice = $totalPrice;
    }

    /**
     * @return mixed
     */
    public function getRolls()
    {
        return $this->_rolls;
    }

    /**
     * @param mixed $rolls
     */
    public function setRolls($rolls)
    {
        $this->_rolls = $rolls;
    }

    /**
     * @return mixed
     */
    public function getApp()
    {
        return $this->_app;
    }

    /**
     * @param mixed $app
     */
    public function setApp($app)
    {
        $this->_app = $app;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->_totalPrice;
    }

    /**
     * @param mixed $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->_totalPrice = $totalPrice;
    }


}
