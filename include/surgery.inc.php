<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 17/08/2017
 * Time: 12:32
 */

include('initializer.php');
$_MENU_ = 'surgeries';

/** @var Surgery $surgery */
$surgery = Surgery::getById($_GET['id']);

if ($surgery === false || $surgery->getIdCustomer() !== (int) $_SESSION['id'])
{
    header("Location:/accueil");
}

$_TITLE_ = $surgery->getName();

$materials = Material::getAllByCustomer($_SESSION['id']);
$questions = Question::getAllByCustomer($_SESSION['id']);
$patients = Patient::getAllByCustomer($_SESSION['id']);

include($_SERVER['DOCUMENT_ROOT'] . "/template/surgery.tpl.php");
