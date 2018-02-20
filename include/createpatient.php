<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 24/08/2017
 * Time: 15:35
 */

include 'initializer.php';

$patient = new Patient();

$patient->setId(Patient::getNextId());
$patient->setIdCustomer($_SESSION['id']);
/*$patient->setLastname('Doe');
$patient->setFirstname('John');
$patient->setSex(0);
$patient->setAge(33);*/

$patient->setMaterials([]);
$patient->setResponses([]);
$patient->setSurgeries([]);

$patient->save(true);

header('Location:/patients/' . $patient->getId());