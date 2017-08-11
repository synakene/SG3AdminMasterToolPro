<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 11/08/2017
 * Time: 10:49
 */

session_start();

if (isset($_SESSION['mail']))
{
    unset($_SESSION['mail']);
}

$_SESSION['error'] = 'Vous êtes maintenant déconnecté';
header('Location: /login');