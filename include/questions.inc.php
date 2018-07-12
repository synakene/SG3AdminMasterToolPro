<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 10/08/2017
 * Time: 13:54
 */

include('initializer.php');
$_MENU_ = 'questions';
$_TITLE_ = 'Questions';

$questions = Question::getAllByCustomer($_SESSION['id']);

include($_SERVER['DOCUMENT_ROOT'] . "/template/questions.tpl.php");