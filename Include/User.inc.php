<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 20/10/2017
 * Time: 11:22
 */

include('Initializer.php');
$_MENU_ = 'utilisateurs';

if ($_SESSION['id'] != $_GET['id'] && Customer::isAdmin($_SESSION['id']) !== true)
{
    header('Location:/accueil');
}

$user = Customer::getById($_GET);

include ($_SERVER['DOCUMENT_ROOT'] . "/Template/user.tpl.php");