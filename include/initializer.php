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
    include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . strtolower($class_name) . '.class.php';
}

include('config.php');

if (!isset($_SESSION))
{
    session_start();
}

DBA::setDba();

if (isset($_SESSION['mail']) === false || isset($_SESSION['id']) === false || Customer::getById($_SESSION['id']) === false)
{
    header('Location:/login');
}
$name = $_SESSION['mail'];

// Test if admin
$id = $_SESSION['id'];
$admin = DBA::getDba()->query("SELECT `admin` FROM `customer` WHERE `id` = $id")->fetch_array(MYSQLI_ASSOC)['admin'];
$_SESSION['admin'] = ($admin === '1' ? true : false);

$_MENU_ = 'index';
$_TITLE_ = 'Accueil';