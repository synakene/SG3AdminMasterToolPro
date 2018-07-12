<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 02/08/2017
 * Time: 11:23
 */

include('initializer.php');
$_MENU_ = 'surgeries';
$_TITLE_ = 'Chirurgies';

$surgeries = Surgery::getAllByCustomer($_SESSION['id']);
$materials = Material::getAllByCustomer($_SESSION['id'], true);
$patients = Patient::getAllByCustomer($_SESSION['id'], true);

include($_SERVER['DOCUMENT_ROOT'] . "/template/surgeries.tpl.php");