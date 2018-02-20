<?php
/**
 * Created by PhpStorm.
 * User: Raph
 * Date: 19/10/2017
 * Time: 17:33
 */

include 'initializer.php';

$surgery = new Surgery();

$surgery->setId(Surgery::getNextId());
$surgery->setIdCustomer($_SESSION['id']);
$surgery->setEmergency(false);

$surgery->setMaterials([]);
$surgery->setResponses([]);
$surgery->setCompatibles([]);

$surgery->save(true);

header('Location:/chirurgies/' . $surgery->getId());