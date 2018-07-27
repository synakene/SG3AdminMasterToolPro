<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 23/08/2017
 * Time: 16:20
 */

include('initializer.php');
$_MENU_ = 'patients';

/** @var Patient $patient */
$patient = Patient::getById($_GET['id'], true);

if ($patient === false || (int) $patient->getIdCustomer() !== (int) $_SESSION['id'])
{
    header("Location:/accueil");
}

$_TITLE_ = $patient->getFirstname() . ' ' . $patient->getLastname();

$materials = Material::getAllByCustomer($_SESSION['id'], false, true);
$questions = Question::getAllByCustomer($_SESSION['id'], true);
$surgeries = Surgery::getAllByCustomer($_SESSION['id'], true);
$avatars = Customer::getAvatars($_SESSION['id']);

include($_SERVER['DOCUMENT_ROOT'] . "/template/patient.tpl.php");