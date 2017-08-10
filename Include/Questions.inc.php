<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 10/08/2017
 * Time: 13:54
 */

include('Initializer.php');

$surgeries = Surgery::getAllByCustomer(1);
foreach ($surgeries as $surgery)
{
    var_dump($surgery);
}
die;

include ($_SERVER['DOCUMENT_ROOT'] . "/Template/Surgeries.tpl.php");