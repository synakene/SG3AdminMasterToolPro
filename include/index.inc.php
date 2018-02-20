<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 01/08/2017
 * Time: 17:54
 */

include('initializer.php');

$numSurgeries = Surgery::getNumRowsByCustomer($_SESSION['id']);
$numPatients = Patient::getNumRowsByCustomer($_SESSION['id']);
$numQuestions = Question::getNumRowsByCustomer($_SESSION['id']);
$numMaterials = Material::getNumRowsByCustomer($_SESSION['id']);

include($_SERVER['DOCUMENT_ROOT'] . "/template/index.tpl.php");