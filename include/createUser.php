<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 03/07/2018
 * Time: 11:20
 */

include 'initializer.php';

$customer = new Customer(true);

if ($customer->Save())
{
    $url = '/utilisateur/' . $customer->getId();
    header('Location:' . $url);
}
else
{
    header('Location:/utilisateurs');
}

