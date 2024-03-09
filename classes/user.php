<?php
class user {

    private $_id;

    private $_username;

    private $_password;

    /**
     * @param $_id
     * @param $_username
     * @param $_password
     */
    public function __construct($id, $username, $password)
    {
        $this->_id = $id;
        $this->_username = $username;
        $this->_password = $password;
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



}