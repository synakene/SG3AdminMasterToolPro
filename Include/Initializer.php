<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 01/08/2017
 * Time: 17:59
 * @param string $class_name
 */

/**
 * @param string $class_name
 */
function __autoload($class_name = '')
{
    include $_SERVER['DOCUMENT_ROOT'] . '/Classes/' . $class_name . '.class.php';
}

include('Config.php');

if (!isset($_SESSION))
{
    session_start();
}

DBA::setDba();

if (isset($_SESSION['mail']) === false || isset($_SESSION['id']) === false)
{
    header('Location:/login');
}
$name = $_SESSION['mail'];