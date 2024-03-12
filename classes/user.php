<?php
class user {

    private $_id;

    private $_username;

    private $_password;
    private $_fname;
    private $_lname;
    private $_email;
    private $_phone;
    private $_points_earned;
    private $_points_used;

    /**
     * @param $_id
     * @param $_username
     * @param $_password
     * @param $_fname
     * @param $_lname
     * @param $_email
     * @param $_phone
     */
    public function __construct($id="",$username="", $password="", $fname="", $lname="",$email="", $phone="", $points_earned="", $points_used="")
    {
        $this->_id = $id;
        $this->_username = $username;
        $this->_password = $password;
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_email = $email;
        $this->_phone = $phone;
        $this->_points_earned = $points_earned;
        $this->_points_used = $points_used;

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @return mixed
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param mixed $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return mixed
     */
    public function getLName()
    {
        return $this->_lname;
    }

    /**
     * @param mixed $lname
     */
    public function setLName($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return int
     */
    public function getPointsEarned()
    {
        return $this->_points_earned;
    }

    /**
     * @param int $points_earned
     */
    public function setPointsEarned($points_earned)
    {
        $this->_points_earned = $points_earned;
    }

    /**
     * @return int
     */
    public function getPointsUsed()
    {
        return $this->_points_used;
    }

    /**
     * @param int $points_used
     */
    public function setPointsUsed($points_used)
    {
        $this->_points_used = $points_used;
    }



}