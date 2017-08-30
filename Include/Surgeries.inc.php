<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 02/08/2017
 * Time: 11:23
 */

include('Initializer.php');
$_MENU_ = 'surgeries';

$surgeries = Surgery::getAllByCustomer($_SESSION['id']);
$materials = Material::getAllByCustomer($_SESSION['id'], true);
$patients = Patient::getAllByCustomer($_SESSION['id'], true);

include ($_SERVER['DOCUMENT_ROOT'] . "/Template/Surgeries.tpl.php");