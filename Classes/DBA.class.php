<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 02/08/2017
 * Time: 09:53
 */

class DBA
{
    private static $dba;

    /**
     * Return the pdo connection to dba
     * @return mixed
     */
    public static function getDba()
    {
        return self::$dba;
    }

    /**
     * Set connection to dba with config.php variables
     * @return void
     */
    public static function setDba()
    {
        try {
            self::$dba = new mysqli(_DBA_HOST_, _DBA_USERNAME_, _DBA_PASSWORD_, _DBA_NAME_);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Used for all connections to database
     * @param $query
     * @return mixed
     */
    public static function query($query)
    {
        /*$valid = self::$dba->query($query);
        if ($valid === false)
        {
            echo 'Requête invalide : \n';
            echo $query;
            die;
        }
        return $valid;*/
        return self::$dba->query($query);
    }

    public static function mquery($query)
    {
        return self::$dba->multi_query($query);
    }
}