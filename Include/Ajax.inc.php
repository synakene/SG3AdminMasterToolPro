<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 16/08/2017
 * Time: 10:37
 */

include('Initializer.php');

/**
 * Save data on the database
 * @param string $table
 * @param array $data
 * @return array
 * @internal param string $type
 */
function saveData($table = '', $data = array())
{
    if ($table === '' || !is_array($data))
    {
        return array(0, 'Erreur d\'envoi des données, veuillez contacter le webmaster.');
    }

    if (intval($data['id']) === 0)
    {
        return array(0, 'ID invalide, veuillez contacter le webmaster.');
    }

    switch ($table)
    {
        case 'material':

            $material = Material::getById(intval($data['id']));
            if ($material === false)
            {
                $material = new Material($data['id'], $_SESSION['id'], $data['name'], $data['category']);
                $win = $material->save();

                if ($win === true)
                {
                    return array(true, 'Materiel crée');
                }

                return array(0, 'Données non valides, sauvegarde impossible du nouveau matériel');
            }

            $material->setName($data['name']);
            $material->setCategory($data['category']);

            if ($material->save() === false)
            {
                return array(0, 'Données non valides, sauvegarde impossible');
            }

            return array(true, 'Matériel sauvegardé');

        case 'question':
            $question = Question::getById($data['id']);

            if ($question === false)
            {
                $question = new Question($data['id'], $_SESSION['id'], $data['name'], $data['question'], $data['answer']);

                if ($question->save())
                {
                    return array(true, 'Question créée');
                }
                return array(0, 'Données non valides, sauvegarde impossible de la nouvelle question');
            }
            $question->setName($data['name']);
            $question->setAnswer($data['answer']);

            if ($question->save() === false)
            {
                return array(0, 'Données non valides, sauvegarde impossible');
            }
            return array(true, 'Question sauvegardée');

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

    $message = 'Valeur de table erronée. Veuillez contacter le webmaster.';
    $win = false;

    switch ($table)
    {
        case 'material':
            $dummy = new Material($id, 1, ' ', ' ');
            $win = $dummy->destroy();
            if ($win === true)
            {
                $message = 'Matériel supprimé.';
            }
            else
            {
                $message = 'Impossible de supprimer le matériel. Veuillez contacter le webmaster.';
            }
            break;

        case 'question':
            $dummy = new Question($id, 1, '', '');
            $win = $dummy->destroy();
            if ($win === true)
            {
                $message = 'Question supprimée.';
            }
            else
            {
                $message = 'Impossible de supprimer la question. Veuillez contacter le webmaster.';
            }
            break;
    }

    return array($win, $message);
}