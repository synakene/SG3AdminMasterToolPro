<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 23/08/2017
 * Time: 16:20
 */

include('initializer.php');
$_MENU_ = 'patients';

$patient = Patient::getById($_GET['id']);

if ($patient === false || (int) $patient->getIdCustomer() !== (int) $_SESSION['id'])
{
    header("Location:/accueil");
}

$materials = Material::getAllByCustomer($_SESSION['id'], true);
$questions = Question::getAllByCustomer($_SESSION['id'], true);
$surgeries = Surgery::getAllByCustomer($_SESSION['id'], true);
$avatars = Customer::getAvatars($_SESSION['id']);

include($_SERVER['DOCUMENT_ROOT'] . "/template/patient.tpl.php");