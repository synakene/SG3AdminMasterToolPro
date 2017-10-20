<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 25/09/2017
 * Time: 15:08
 */

include('Initializer.php');
$_MENU_ = 'avatars';

$avatars = Customer::getAvatars($_SESSION['id']);
// TODO afficher tout les avatars si admin
// TODO modifier l'image via l'interface admin
include ($_SERVER['DOCUMENT_ROOT'] . "/Template/avatars.tpl.php");