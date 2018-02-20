<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 16/08/2017
 * Time: 10:37
 */

include('initializer.php');

function escapeInjections($data)
{
    if (is_array($data))
    {
        foreach ($data as $index => $data_element)
        {
            $data[$index] = escapeInjections($data_element);
        }
    }
    else if (is_string($data))
    {
        $data = DBA::getDba()->real_escape_string($data);
    }

    return $data;
}

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
            //$patient->setStory($data['story']);

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
            $dummy = new Material($id, $_SESSION['id'], ' ', ' ');
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
            $dummy = new Question($id, $_SESSION['id'], '', '');
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

function addPack($idCustomer, $packId, $adding)
{
    if ($adding)
    {
        return Customer::AddPack($idCustomer, $packId);
    }
    else
    {
        return Customer::RemovePack($idCustomer, $packId);
    }
}

function changeMail($customerId, $mail)
{
    $user = Customer::getById($customerId);
    if ($user)
    {
        $user->setMail($mail);
        return $user->SaveMail();
    }
    return false;
}

function changePass($customerId, $pass)
{
    $user = Customer::getById($customerId);
    if ($user)
    {
        return $user->setPass($pass);
    }
    return false;
}

function changeAPI($customerId, $key)
{
    $user = Customer::getById($_POST['data']['idCustomer']);
    if ($user)
    {
        $user->setApiKey($key);
        return $user->SaveApiKey();
    }
    return false;
}

function importJsons($customerId, $jsons)
{
    $jsons = escapeInjections($jsons);

    $result = array(
        'win' => '0',
        'message' => 'Erreur inconnue. Contacter votre webmaster.'
    );

    DBA::startTransaction();

    //region Materials creating
    $materials = array();
    $id = Material::getNextId();
    foreach ($jsons['materials']['materiels'] as $matJson)
    {
        $material = new Material();
        $material->setName($matJson['materiel']);
        $material->setCategory($matJson['cat']);
        $material->setIdCustomer($customerId);
        $material->setId($id++);

        if ($material->save())
        {
            $materials[$matJson['id']] = $material;
        }
        else
        {
            DBA::cancelTransaction();
            $result['message'] = "Erreur dans la création du matériel " . $matJson['materiel'];
            return $result;
        }
    }
    //endregion

    //region Questions creating
    $questions = array();
    $id = Question::getNextId();
    foreach ($jsons['questions']['questions'] as $qJson)
    {
        $question = new Question();
        $question->setId($id++);
        $question->setIdCustomer($customerId);
        $question->setName($qJson['id']);
        $question->setQuestion($qJson['question']);
        $question->setAnswer($qJson['reponse']);

        if ($question->save())
        {
            $questions[$qJson['id']] = $question;
        }
        else
        {
            DBA::cancelTransaction();
            $result['message'] = "Erreur dans la création de la question " . $qJson['question'];
            return $result;
        }
    }
    //endregion

    //region Patients Creating
    $patients = array();
    $id = Patient::getNextId();
    foreach ($jsons['patients']['patients'] as $patJson)
    {
        $patient = new Patient();
        $patient->setId($id++);
        $patient->setIdCustomer($customerId);
        $patient->setLastname($patJson['nom']);
        $patient->setFirstname($patJson['prenom']);

        $sex = $patJson['sexe'];
        $sexIndex = 2;
        if ($sex == 'Homme')
            $sexIndex = 0;
        else if ($sex == 'Femme')
            $sexIndex = 1;
        $patient->setSex($sexIndex);

        $patient->setAge($patJson['age']);
        $patient->setHeight($patJson['taille']);
        $patient->setWeight($patJson['poid']);
        $patient->setAvatar($patJson['avatar']);

        if (isset($patJson['materiels']))
        {
            $materialsIds = array();
            foreach ($patJson['materiels'] as $matIdJson)
            {
                if (isset($materials[$matIdJson]))
                {
                    array_push($materialsIds, $materials[$matIdJson]->getId());
                }
            }
            $patient->setMaterials($materialsIds);
        }

        if (isset($patJson['reponses']))
        {
            $responses = array();
            foreach ($patJson['reponses'] as $responseJson) {
                $name = (array_keys($responseJson)[0]);
                $answer = $responseJson[$name];

                if (isset($questions[$name])) {
                    array_push($responses, array(
                        'id' => $questions[$name]->getId(),
                        'questionName' => $name,
                        'defaultAnswer' => $questions[$name]->getQuestion(),
                        'answer' => $answer,
                    ));
                }
            }
            $patient->setResponses($responses);
        }

        if ($patient->save())
        {
            $patients[intval($patJson['id'])] = $patient;
        }
        else
        {
            DBA::cancelTransaction();
            $result['message'] = "Erreur dans la création du patient " . $patJson['prenom'] . " " . $patJson['nom'];
            return $result;
        }
    }
    //endregion

    //region Surgeries Creating
    $surgeries = array();
    $id = Surgery::getNextId();
    foreach ($jsons['surgeries']['chirurgies'] as $chirJson)
    {
        $surgery = new Surgery();
        $surgery->setId($id++);
        $surgery->setIdCustomer($customerId);
        $surgery->setName($chirJson['nom']);

        if (isset($chirJson['materiels']))
        {
            $materialsIds = array();
            foreach ($chirJson['materiels'] as $matIdJson)
            {
                if (isset($materials[$matIdJson]))
                {
                    array_push($materialsIds, $materials[$matIdJson]->getId());
                }
            }
            $surgery->setMaterials($materialsIds);
        }

        if (isset($chirJson['reponses']))
        {
            $responses = array();
            foreach ($chirJson['reponses'] as $responseJson) {
                $name = (array_keys($responseJson)[0]);
                $answer = $responseJson[$name];

                if (isset($questions[$name])) {
                    array_push($responses, array(
                        'id' => $questions[$name]->getId(),
                        'questionName' => $name,
                        'defaultAnswer' => $questions[$name]->getQuestion(),
                        'answer' => $answer,
                    ));
                }
            }
            $surgery->setResponses($responses);
        }


        if (isset($chirJson['compatibles']))
        {
            $chirPatients = array();
            foreach ($chirJson['compatibles'] as $compatible)
            {
                if (isset($patients[$compatible]))
                {
                    array_push($chirPatients, $patients[$compatible]->getId());
                }
            }
            $surgery->setCompatibles($chirPatients);
        }

        $surgery->setStory($chirJson['histoire']);

        if ($surgery->save())
        {
            $surgeries[$chirJson['id']] = $surgery;
        }
        else
        {
            DBA::cancelTransaction();
            $result['message'] = "Erreur dans la création de la chirurgie " . $chirJson['nom'];
            return $result;
        }
    }
    //endregion

    //DBA::cancelTransaction();
    DBA::finishTransaction();
    $responses['win'] = '1';
    $result['message'] = "Jsons importés avec succès !";
    return $result;
}