<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 10/08/2017
 * Time: 16:35
 */

include $_SERVER['DOCUMENT_ROOT'] . '/Classes/DBA.class.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Classes/Customer.class.php';
include('Config.php');
DBA::setDba();

session_start();

//$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
$pass = $_POST['password'];
$query = Customer::getByMail($_POST['email']);

if ($query === false)
{
    $_SESSION['error'] = 'Mail inconnu';

    header('Location:/login');
}
else if (password_verify($pass, $query[0]['password']))
{
    $_SESSION['mail'] = $query[0]['mail'];
    $_SESSION['password'] = $query[0]['password'];
    $_SESSION['id'] = $query[0]['id'];
    $_SESSION['admin'] = $query[0]['admin'];

    header('Location:/accueil');
}
else
{
    $_SESSION['error'] = 'Mot de passe invalide';
    header('Location:/login');
}
