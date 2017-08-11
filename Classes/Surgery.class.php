<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 01/08/2017
 * Time: 17:44
 */

class Surgery extends DBA
{
    public function __construct()
    {

    }

    public function hydrate()
    {

    }

    public static function getAllByCustomer($customerID)
    {
        $surgeries = self::query("SELECT * FROM `surgery` WHERE `idCustomer` =  . $customerID");

        if ($surgeries === false)
        {
            return false;
        }

        $surgeries_with_infos = array();

        /*foreach ($surgeries as $surgery)
        {
            $materials = self::query('');
        }*/
    }
}