<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 02/08/2017
 * Time: 12:50
 */

include('Initializer.php');

$materials = Material::getAllByCustomer(1);

$fetchedCategories = Material::getCategoriesByCustomer(1);

$categories = '[';
foreach ($fetchedCategories as $category)
{
    $categories .= '"' . $category['category'] . '", ';
}
$categories .= ']';

include ($_SERVER['DOCUMENT_ROOT'] . "/Template/Materials.tpl.php");