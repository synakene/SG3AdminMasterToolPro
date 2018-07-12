<?php
/**
 * Created by PhpStorm.
 * User: Raph
 * Date: 03/07/2018
 * Time: 11:47
 */

include('initializer.php');

if (Customer::isAdmin($_SESSION['id']) !== true)
{
    header('Location:/accueil');
}

$customer = Customer::getById($_GET['id']);
if (!$customer)
{
    header('Location:/utilisateurs');
}

if ($customer->Delete())
{
    header('Location:/utilisateurs');
}
header('Location:/utilisateur/' . $customer->getId());