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
            self::$dba->set_charset("utf8");
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Used for all connections to database
     * @param $query
     * @return mixed
     */
    public static function query($query, $debug = true)
    {
        $result = self::$dba->query($query);
        if ($result == false && $debug)
        {
            echo ("Query error : " . self::$dba->error . " in " . $query . '<br>');
            xdebug_print_function_stack();
        }

        return $result;
    }

    /**
     * Used for all connections to database
     * Used for for multiples queries at once
     * @param $query
     * @return mixed
     */
    public static function mquery($query)
    {
        $win = self::$dba->multi_query($query);
        while (self::$dba->more_results())
        {
            self::$dba->next_result();
        }

        return $win;
    }

    public static function startTransaction()
    {
        self::$dba->begin_transaction();
    }

    public static function finishTransaction()
    {
        self::$dba->commit();
    }

    public static function cancelTransaction()
    {
        self::$dba->rollback();
    }
}
