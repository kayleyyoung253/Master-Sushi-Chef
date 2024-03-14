<?php
/**
 * @authors Levi Miller, Kayley Young
 * user_updates.php
 * holds getters and setters for user_updates class
 */
class user_updates extends user
{

    private $_updates;

    /**
     * @param $_updates
     */
    public function __construct($_updates="")
    {
        $this->_updates = $_updates;
    }

    /**
     * @return mixed
     */
    public function getUpdates()
    {
        return $this->_updates;
    }

    /**
     * @param mixed $updates
     */
    public function setUpdates($updates)
    {
        $this->_updates = $updates;
    }



}