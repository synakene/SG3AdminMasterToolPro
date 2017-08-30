<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 02/08/2017
 * Time: 11:23
 */

include('Initializer.php');
$_MENU_ = 'surgeries';

$surgeries = Surgery::getAllByCustomer($_SESSION['id']);
$materials = Material::getAllByCustomer($_SESSION['id'], true);
$patients = Patient::getAllByCustomer($_SESSION['id'], true);

// Easy access to materials and questions name for display
$patientsNames = [];
$materialsNames = [];
foreach ($surgeries as $surgery)
{
    foreach ($surgery->getMaterials() as $materialId)
    {
        $materialsNames[$materialId] = $materials[$materialId]->getName();
    }

    foreach ($surgery->getCompatibles() as $patientId)
    {
        $patientsNames[$patientId] = $patients[$patientId]->getFirstname() . ' ' . $patients[$patientId]->getLastname();
    }
}

include ($_SERVER['DOCUMENT_ROOT'] . "/Template/Surgeries.tpl.php");