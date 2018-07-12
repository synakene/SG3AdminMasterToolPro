<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 02/08/2017
 * Time: 12:50
 */

include('initializer.php');
$_MENU_ = 'materials';
$_TITLE_ = 'Matériel';

$materials = Material::getAllByCustomer($_SESSION['id']);

$fetchedCategories = Material::getCategoriesByCustomer($_SESSION['id']);

$categories = '[';
foreach ($fetchedCategories as $category)
{
    $categories .= '"' . $category['category'] . '", ';
}
$categories .= ']';

include($_SERVER['DOCUMENT_ROOT'] . "/template/materials.tpl.php");