<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 17/08/2017
 * Time: 12:32
 */

include('Initializer.php');

$surgery = Surgery::getById($_GET['id']);

if ($surgery === false || $surgery->getIdCustomer() !== (int) $_SESSION['id'])
{
    header("Location:/accueil");
}

$materials = Material::getAllByCustomer($_SESSION['id']);
$questions = Question::getAllByCustomer($_SESSION['id']);
//$patient = Patient::

include ($_SERVER['DOCUMENT_ROOT'] . "/Template/Surgery.tpl.php");
