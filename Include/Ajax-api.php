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
        return array(0, 'Erreur d\'envoi des données, veuillez contacter le webmaster.');
    }

    switch ($table)
    {
        case 'material':
            if (intval($data['id']) === 0)
            {
                return array(0, 'ID invalide, veuillez contacter le webmaster.');
            }

            $material = Material::getById(intval($data['id']));
            if ($material === false)
            {
                // TODO id customer à custom
                $material = new Material($data['id'], 1, $data['name'], $data['category']);
                $win = $material->save();

                if ($win === true)
                {
                    return array(true, 'Materiel crée');
                }

                return array(0, 'Données non valides, sauvegarde impossible');
            }

            $material->setName($data['name']);
            $material->setCategory($data['category']);

            if ($material->save() === false)
            {
                return array(0, 'Données non valides, sauvegarde impossible');
            }

            return array(true, 'Matériel sauvegardé');

        default :
            return array(0, 'Type de donnée non reconnue, veuillez contactez votre webmaster');
    }
}

function getData($table = '', $id = 0, $columns = '')
{
    if ($table == '' || $id == 0 || $columns == '')
    {
        return array(0, 'Erreur d\'envoi des données, veuillez contacter le webmaster.');
    }

    $data = array();

    switch ($table)
    {
        case 'material':
            $material = Material::getById($id);

            if ($material === false)
            {
                return array(0, 'Le materiel n\'existe pas');
            }
            break;

        default:
            return array(0, 'Type de donnée non reconnue, veuillez contactez votre webmaster');
    }

    return array(true, $data);
}

function deleteData($table = '', $id = 0)
{
    if ($table == '' || $id == 0)
    {
        return array(0, 'Erreur d\'envoi des données, veuillez contacter le webmaster.');
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
        echo '0';
        die;
    }

    echo true . '<br>';
    echo $id;
    die;
}
else if ($_POST['action'] === 'deleteData')
{
    $table = $_POST['type'];
    $id = $_POST['data']['id'];

    $dummy = new Material($id, 1, ' ', ' ');
    $win = $dummy->destroy();
    if ($win === true)
    {
        echo 1 . '<br>';
        echo 'Materiel supprimé';
    }
    else
    {
        echo -1 . '<br>';
        echo 'Impossible de supprimer le matériel. Contacter le webmaster.';
    }
    die;
}