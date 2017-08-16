<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 02/08/2017
 * Time: 11:23
 */

include('Initializer.php');

$surgeries = Surgery::getAllByCustomer(1);
$surgeriesJson = json_encode($surgeries, JSON_UNESCAPED_UNICODE);


include ($_SERVER['DOCUMENT_ROOT'] . "/Template/Surgeries.tpl.php");