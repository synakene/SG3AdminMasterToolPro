<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 07/08/2017
 * Time: 11:09
 */

include('ajax.inc.php');
header('Content-Type: text/html');

// Uncomment to preview html in network view, thx web browsers debuggers...
//2018
//http_response_code(500);

if (!isset($_SESSION['mail']) || $_SESSION['mail'] == '' || !isset($_SESSION['id']) || $_SESSION['id'] == '')
{
    echo 0 . '<br>';
    echo 'Erreur d\'authentification, veuillez vous reconnecter. Si le problème persiste, contactez votre webmaster.';
    die;
}

$ajax_caller = Customer::getById($_SESSION['id']);
if ($ajax_caller == false)
{
    echo 0 . '<br>';
    echo 'Erreur d\'authentification, veuillez vous reconnecter. Si le problème persiste, contactez votre webmaster.';
    die;
}
$admin = $ajax_caller->isAdmin();

// Escape injections
if (isset($_POST['data']))
{
    $_POST['data'] = escapeInjections($_POST['data']);
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
else if ($_POST['action'] === 'updateAvatar')
{
    if (Patient::saveAvatar($_POST['data']['id'], $_POST['data']['name'], $_POST['data']['pack']) === true)
    {
        echo 1 . '<br>';
        echo 'Avatar sauvegardé';
    }
    else
        {
        echo 0 . '<br>';
        echo 'Avatar non sauvegardé, valeur(s) invalide(s)';
    }
    die;
}
else if ($_POST['action'] === 'addPack' && $admin)
{
    $idPack = (int) $_POST['data']['idPack'];
    $idCustomer = (int) $_POST['data']['idCustomer'];
    $adding = boolval($_POST['data']['adding']);
    $win = AddPack($idCustomer, $idPack, $adding);

    echo $win . '<br>';
    if ($win && $adding)
    {
        echo "Pack ajouté";
    }
    else if ($win && !$adding)
    {
        echo 'Pack retiré';
    }
    else
    {
        echo 'Erreur, veuillez contactez votre webmaster.';
    }
}
else if ($_POST['action'] === 'changemail')
{
    if ($_SESSION['mail'] != $_POST['data']['mail'] && !$_SESSION['admin'])
    {
        echo "0<br>Mail non modifié. Erreur d'authentification. Contactez votre webmaster.";
    }
    else
    {
        $win = changeMail($_POST['data']['idCustomer'], $_POST['data']['mail']);
        if ($win)
        {
            echo "1<br>Mail modifié.";
        }
        else
        {
            echo "0<br>Mail non modifié. Contactez votre webmaster.";
        }
    }
}
else if ($_POST['action'] === 'changepass')
{
    if ($_SESSION['mail'] != $_POST['data']['mail'] && !$_SESSION['admin'])
    {
        echo "0<br>Mot de passe non modifié. Erreur d'authentification. Contactez votre webmaster.";
    }
    else
    {
        $win = changePass($_POST['data']['idCustomer'], $_POST['data']['pass']);
        if ($win)
        {
            echo '1<br>Mot de passe modifié.';
        }
        else
        {
            echo '0<br>Mot de passe non modifié. Contactez votre webmaster.';
        }
    }
}
else if ($_POST['action'] == 'changeapi' && $admin)
{
    $win = changeAPI($_POST['data']['idCustomer'], $_POST['data']['key']);
    if ($win)
    {
        echo "1<br>Clef modifiée.";
    }
    else
    {
        echo "0<br>Clef non modifiée. Contactez votre webmaster.";
    }
}
else if ($_POST['action'] === 'importJson')
{
    $result = importJsons($_POST['idCustomer'], $_POST['streamingAssets']);
    echo ($result['win'] . '<br>' . $result['message']);
}
else
{
    echo false . '<br>';
    echo 'Commande inconnue ou autorisation insufisante, veuillez contacter le webmaster';
    die;
}