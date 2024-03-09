<?php
class order
{

    private $_rolls;

    private $_app;

    private $_totalPrice;

    /**
     * @param $_rolls
     * @param $_app
     * @param $_totalPrice
     */
    public function __construct($_rolls, $_app, $_totalPrice)
    {
        $this->_rolls = $_rolls;
        $this->_app = $_app;
        $this->_totalPrice = $_totalPrice;
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
