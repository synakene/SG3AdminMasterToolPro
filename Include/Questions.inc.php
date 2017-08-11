<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 10/08/2017
 * Time: 13:54
 */

include('Initializer.php');

$questions = Question::getAllByCustomer($_SESSION['id']);

include ($_SERVER['DOCUMENT_ROOT'] . "/Template/Questions.tpl.php");