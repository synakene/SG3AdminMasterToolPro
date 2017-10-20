<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 26/09/2017
 * Time: 10:36
 */

include('Initializer.php');
$_MENU_ = 'utilisateurs';

if (Customer::isAdmin($_SESSION['id']) !== true)
{
    header('Location:/accueil');
}

$users = Customer::getAll();

include ($_SERVER['DOCUMENT_ROOT'] . "/Template/users.tpl.php");