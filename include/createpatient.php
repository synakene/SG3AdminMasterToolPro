<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 24/08/2017
 * Time: 15:35
 */

include 'initializer.php';

$patient = new Patient(true);

$patient->setId(Patient::getNextId());
$patient->setIdCustomer($_SESSION['id']);

$patient->setMaterials([]);
$patient->setResponses([]);
$patient->setSurgeries([]);

$win = $patient->save(true);
header('Location:/patients/' . $patient->getId());