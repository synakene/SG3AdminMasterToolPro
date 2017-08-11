<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 01/08/2017
 * Time: 17:44
 */

class Customer extends DBA
{
    public static function getById($id = 0)
    {
        return self::query("SELECT * FROM `customer` WHERE `id` = $id")->fetch_all(MYSQLI_ASSOC);
    }

    public static function getByMail($mail = '')
    {
        return self::query("SELECT * FROM `customer` WHERE `mail` = '$mail'")->fetch_all(MYSQLI_ASSOC);
    }

    public static function getUserHash($mail = '')
    {
        return self::query("SELECT `password` FROM `customer` WHERE `mail` = '$mail'")->fetch_all(MYSQLI_ASSOC);
    }
}