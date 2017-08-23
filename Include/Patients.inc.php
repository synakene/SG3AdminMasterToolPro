<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 23/08/2017
 * Time: 12:52
 */

include('Initializer.php');

$surgeries = Surgery::getAllByCustomer($_SESSION['id'], true);
$materials = Material::getAllByCustomer($_SESSION['id'], true);
$patients = Patient::getAllByCustomer($_SESSION['id'], true);

include ($_SERVER['DOCUMENT_ROOT'] . "/Template/Patients.tpl.php");