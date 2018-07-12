<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 25/09/2017
 * Time: 15:08
 */

include('initializer.php');
$_MENU_ = 'avatars';
$_TITLE = 'Avatars';

$avatars = Customer::getAvatars($_SESSION['id'], false);

// TODO afficher tout les avatars si admin
// TODO modifier l'image via l'interface admin
include($_SERVER['DOCUMENT_ROOT'] . "/template/avatars.tpl.php");