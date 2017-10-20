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
function saveData($table = '', $data = array()) // TODO : gérer les id faux
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
                return array(0, 'Données non valides, sauvegarde impossible.');
            }

            return array(true, 'Matériel sauvegardé.');

        case 'question':
            $question = Question::getById($data['id']);

            if ($question === false)
            {
                $question = new Question($data['id'], $_SESSION['id'], $data['name'], $data['question'], $data['answer']);

                if ($question->save())
                {
                    return array(true, 'Question créée.');
                }
                return array(0, 'Données non valides, sauvegarde impossible de la nouvelle question.');
            }
            $question->setName($data['name']);
            $question->setQuestion($data['question']);
            $question->setAnswer($data['answer']);

            if ($question->save() === false)
            {
                return array(0, 'Données non valides, sauvegarde impossible.');
            }
            return array(true, 'Question sauvegardée.');

        case 'surgery':
            $surgery = Surgery::getById($data['id']);
            $new = false;

            if ($surgery === false) {
                $new = true;
                $surgery = new Surgery();
            }

            $surgery->setId($data['id']);
            $surgery->setIdCustomer($_SESSION['id']);
            $surgery->setEmergency($data['emergency'] === 'true' ? true : false);
            if (isset($data['compatibles']) === false) { $data['compatibles'] = []; };
            $surgery->setCompatibles($data['compatibles']);
            if (isset($data['materials']) === false) { $data['materials'] = []; };
            $surgery->setMaterials($data['materials']);
            if (isset($data['responses']) === false) { $data['responses'] = []; };
            $surgery->setResponses($data['responses']);
            $surgery->setName($data['name']);
            $surgery->setStory($data['story']);

            if ($surgery->save())
            {
                if ($new === true)
                {
                    return array(true, 'Chirurgie créée.');
                }
                else
                {
                    return array(true, 'Chirurgie mise à jour.');
                }
            }
            else
            {
                if ($new === true)
                {
                    return array(0, 'Création de la chirurgie impossible. Données incorrectes.');
                }
                else
                {
                    return array(0, 'Mise à jour de la chirurgie impossible. Données incorrectes.');
                }
            }

        case 'patient':
            $patient = Patient::getById($data['id']);
            $new = false;

            if ($patient === false) {
                $new = true;
                $patient = new Patient();
            }

            $patient->setId($data['id']);
            $patient->setIdCustomer($_SESSION['id']);

            isset($data['surgeries']) ? null : $data['surgeries'] = [];
            $patient->setSurgeries($data['surgeries']);

            isset($data['materials']) ? null : $data['materials'] = [];
            $patient->setMaterials($data['materials']);

            isset($data['responses']) ? null : $data['responses'] = [];
            $patient->setResponses($data['responses']);

            $patient->setFirstname($data['firstname']);
            $patient->setLastname($data['lastname']);
            $patient->setSex($data['sex']);
            $patient->setAge($data['age']);
            $patient->setHeight($data['height']);
            $patient->setWeight($data['weight']);
            $patient->setAvatar($data['avatar']);

            if ($patient->save())
            {
                if ($new === true)
                {
                    return array(true, 'Patient créé.');
                }
                else
                {
                    return array(true, 'Patient mis à jour.');
                }
            }
            else
            {
                if ($new === true)
                {
                    return array(0, 'Création du patient impossible. Données incorrectes.');
                }
                else
                {
                    return array(0, 'Mise à jour du patient impossible. Données incorrectes.');
                }
            }

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
    $id = intval($id);
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

        case 'patient':
            $patient = new Patient();
            $patient->setId($id);
            $win = $patient->destroy();

            if ($win === true)
            {
                $message = 'Patient supprimé';
            }
            else
            {
                $message = 'Impossible de supprimer le patient. Veuillez contacter le webmaster.';
            }
            break;

        case 'surgery';
            $surgery = new Surgery();
            $surgery->setId($id);
            $win = $surgery->destroy();

            if ($win === true)
            {
                $message = 'Chirurgie supprimée';
            }
            else
            {
                $message = 'Impossible de supprimer la chirurgie. Veuillez contacter le webmaster.';
            }
            break;
    }

    return array($win, $message);
}