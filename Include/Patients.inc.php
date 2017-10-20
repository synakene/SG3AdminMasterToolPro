<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 23/08/2017
 * Time: 12:52
 */

include('Initializer.php');
$_MENU_ = 'patients';

$surgeries = Surgery::getAllByCustomer($_SESSION['id'], true);
$materials = Material::getAllByCustomer($_SESSION['id'], true);
$patients = Patient::getAllByCustomer($_SESSION['id'], true);
$avatars = Patient::getAvatarsByCustomer($_SESSION['id']);

include ($_SERVER['DOCUMENT_ROOT'] . "/Template/Patients.tpl.php");