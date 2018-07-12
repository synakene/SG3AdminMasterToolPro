<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 20/10/2017
 * Time: 11:22
 */

include('initializer.php');
$_MENU_ = 'utilisateurs';

if ($_SESSION['id'] != $_GET['id'] && Customer::isAdmin($_SESSION['id']) !== true)
{
    header('Location:/accueil');
}

/** @var Customer $user */
$user = Customer::getById($_GET['id']);

if (!$user)
{
    header('Location:/utilisateurs');
}
$packs = Customer::getAllPacks();

$_TITLE_ = $user->getMail();

include($_SERVER['DOCUMENT_ROOT'] . "/template/user.tpl.php");