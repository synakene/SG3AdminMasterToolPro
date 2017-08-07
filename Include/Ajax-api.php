<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 07/08/2017
 * Time: 11:09
 */

include('Initializer.php');

function saveData($type = '', $data = array())
{

    if ($type === '' || !is_array($data))
    {
        return array(false, 'data type not sent');
    }

    switch ($type)
    {
        case 'material':
            $materiel = Material::getById(intval($data[0]));

            if ($materiel === false)
            {
                return array(false, 'material not found');
            }

            $materiel->setName($data[1]);
            $materiel->setCategory($data[2]);

            if ($materiel->save() === false)
            {
                return array(false, 'data not valid, can\'t save to the database');
            }

            return array(true, 'material saved to the database');

        default :
            return array(false, 'data type not recognized');
    }
}

if ($_POST['action'] === 'saveData')
{
    // TODO check les data : injections
    // TODO check le login : securité
    $data = $_POST['data'];

    $result = saveData($_POST['type'], $data);

    echo $result[0] . '<br>';
    echo $result[1];
}