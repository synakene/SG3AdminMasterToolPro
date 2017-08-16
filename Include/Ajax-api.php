<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 07/08/2017
 * Time: 11:09
 */

include('Ajax.inc.php');

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
    switch ($_POST['type'])
    {
        case 'material':
            $id = Material::getNextId();
            break;
        case 'question':
            $id = Question::getNextId();
            break;
        default:
            $id = false;
    }

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

    $result = deleteData($table, $id);

    if ($result[0] === true)
    {
        echo 1 . '<br>';
        echo $result[1];
    }
    else
    {
        echo -1 . '<br>';
        echo $result[1];
    }
    die;
}