<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 07/08/2017
 * Time: 11:09
 */

include('Initializer.php');

/**
 * Save data on the database
 * @param string $type
 * @param array $data
 * @return array
 */
function saveData($table = '', $data = array())
{

    if ($table === '' || !is_array($data))
    {
        return array(false, 'Erreur d\'envoi des données, veuillez contacter le webmaster.');
    }

    switch ($table)
    {
        case 'material':
            $material = Material::getById(intval($data[0]));

            if ($material === false)
            {
                // TODO : créer le truc
                return array(false, 'Le materiel n\'existe pas');
            }

            $material->setName($data[1]);
            $material->setCategory($data[2]);

            if ($material->save() === false)
            {
                return array(false, 'Données non valides, sauvegarde impossible');
            }

            return array(true, 'Matériel sauvegardé');

        default :
            return array(false, 'Type de donnée non reconnue, veuillez contactez votre webmaster');
    }
}

function getData($table = '', $id = 0, $columns = '')
{
    if ($table == '' || $id == 0 || $columns == '')
    {
        return array(false, 'Erreur d\'envoi des données, veuillez contacter le webmaster.');
    }

    $data = array();

    switch ($table)
    {
        case 'material':
            $material = Material::getById($id);

            if ($material === false)
            {
                return array(false, 'Le materiel n\'existe pas');
            }
            break;

        default:
            return array(false, 'Type de donnée non reconnue, veuillez contactez votre webmaster');
    }

    return array(true, $data);
}

if ($_POST['action'] === 'saveData')
{
    // TODO check les data : injections
    // TODO check le login : securité
    $data = $_POST['data'];

    $result = saveData($_POST['type'], $data);

    echo $result[0] . '<br>';
    echo $result[1];
    die;
}
else if ($_POST['action'] === 'getData')
{
    $columns = $_POST['data'];

    $result = getData($_POST['type'], $_POST['id'], $columns);

    echo $result[0] . '<br>';
    echo $result[1];
    die;
}
else if ($_POST['action'] === 'getValidId')
{
    $id = Material::getNextId();
    if ($id === false)
    {
        echo id;
        die;
    }
var_dump($id);
    echo true . '<br>';
    echo $id;
    die;
}