<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 10/08/2017
 * Time: 16:35
 */

var_dump($_POST);

$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
var_dump($hash);
var_dump(password_verify($_POST['password'], $hash));

session_start();
$_SESSION['user'] = $_POST['email'];
$_SESSION['password'] = $hash;

include('Initializer.php');