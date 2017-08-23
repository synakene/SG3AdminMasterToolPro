<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 23/08/2017
 * Time: 16:20
 */

include('Initializer.php');

$patient = Patient::getById($_GET['id']);

if ($patient === false || (int) $patient->getIdCustomer() !== (int) $_SESSION['id'])
{
    header("Location:/accueil");
}

$materials = Material::getAllByCustomer($_SESSION['id'], true);
$questions = Question::getAllByCustomer($_SESSION['id'], true);
$surgeries = Surgery::getAllByCustomer($_SESSION['id'], true);

include ($_SERVER['DOCUMENT_ROOT'] . "/Template/Patient.tpl.php");