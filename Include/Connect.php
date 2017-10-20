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

// Admin connection
//var_dump(isset($_GET['id']));var_dump((Customer::isAdmin($_SESSION['id'])));die;
if (isset($_GET['id']) && Customer::isAdmin($_SESSION['id']))
{
    $credentials = Customer::getCredentialsById($_GET['id']);
    $_SESSION['mail'] = $credentials['mail'];
    $_SESSION['id'] = $_GET['id'];
    header('Location:/accueil');
    die;
}

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
    $_SESSION['id'] = $query[0]['id'];

    header('Location:/accueil');
}
else
{
    $_SESSION['error'] = 'Mot de passe invalide';
    header('Location:/login');
}
