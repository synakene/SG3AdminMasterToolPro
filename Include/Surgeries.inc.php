<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 02/08/2017
 * Time: 11:23
 */

include('Initializer.php');

$surgeries = Surgery::getAllByCustomer(1);
foreach ($surgeries as $surgery)
{
    var_dump($surgery);
}
die;

include ($_SERVER['DOCUMENT_ROOT'] . "/Template/Surgeries.tpl.php");