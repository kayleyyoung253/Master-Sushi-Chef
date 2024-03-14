<?php
/**
 * @authors Levi Miller, Kayley Young
 * user.php
 * holds getters and setters for user class
 */
class user {

    private $_id;

    private $_username;

    private $_password;
    private $_fname;
    private $_lname;
    private $_email;
    private $_phone;
    private $_updatesStatus;

    /**
     * @param $_id
     * @param $_username
     * @param $_password
     * @param $_fname
     * @param $_lname
     * @param $_email
     * @param $_phone
     */
    public function __construct($id="",$username="", $password="", $fname="", $lname="",$email="", $phone="")
    {
        $this->_id = $id;
        $this->_username = $username;
        $this->_password = $password;
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_email = $email;
        $this->_phone = $phone;

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
     * Set additional data from Applicant_SubscribedToLists object
     * into the Applicant object
     *
     */
    public function setAdditionalData(user_updates $userUpdated)
    {
        // Set additional data into user object
        $this->_updates = $userUpdated->getUpdates();

    }
    /**
     * Get the updates status of the user.
     * @return bool The updates status (true if enabled, false if disabled)
     */
    public function getUpdatesStatus()
    {
        return $this->_updatesStatus;
    }

    /**
     * Set the updates status of the user.
     * @param bool $status The updates status to set (true for enabled, false for disabled)
     */
    public function setUpdatesStatus($status)
    {
        $this->_updatesStatus = $status;
    }

}