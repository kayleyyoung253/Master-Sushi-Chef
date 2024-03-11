<?php

/*
 * 328/Master-Sushi-Chef/model/validate.php
 * Validate data for the user data
 * @author:Kayley Young and Levi Miller
 */

//return true if name is valid
class Validate
{
    /**
     * validate if any invalid characters were added
     * @param $name
     * @return bool
     */
    static function validName($name)
    {
        if (!ctype_alpha($name)){
            return false;
        }
        return true;
    }



    /**
     * validate if a phone number entered contains only numbers
     * @param $phone
     * @return bool
     */
    static function validPhone($phone)
    {
        if (!is_numeric($phone)) {
            return false;
        }
        return true;
    }

    /**
     * validiate if email entered is correctly formatted
     * @param $email
     * @return bool
     */
    static function validEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }


}