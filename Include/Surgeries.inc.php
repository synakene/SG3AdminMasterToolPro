<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 02/08/2017
 * Time: 11:23
 */

include('Initializer.php');

$surgeries = Surgery::getAllByCustomer($_SESSION['id']);
$surgeriesJson = json_encode($surgeries, JSON_UNESCAPED_UNICODE);

$materials = Material::getAllByCustomer($_SESSION['id']);
$materialsJson = json_encode($materials, JSON_UNESCAPED_UNICODE);

include ($_SERVER['DOCUMENT_ROOT'] . "/Template/Surgeries.tpl.php");