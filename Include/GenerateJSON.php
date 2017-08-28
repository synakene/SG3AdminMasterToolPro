<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 28/08/2017
 * Time: 10:39
 */

include 'Initializer.php';

if ($_GET['type'] === 'materials' || $_GET['type'] === 'all')
{
    $materials = Material::getAllByCustomer($_SESSION['id'], true);
    $length = sizeof($materials);
    $i = 1;

    $json = "{\n\t\"materiels\": [\n\n";
    foreach ($materials as $material)
    {
        $id = $material->getId();
        $name = $material->getName();
        $answer = $material->getCategory();

        $json .= "\t\t{\n";
        $json .= "\t\t\t\"id\": \"$id\" ,\n";
        $json .= "\t\t\t\"materiel\": \"$name\",\n";
        $json .= "\t\t\t\"cat\": \"$answer\" \n";
        $json .= "\t\t}" . ($i === $length ? "\n" : ",\n\n");
        ++$i;
    }
    $json .= "\t]\n}";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/Assets/Materiel.json', $json);
}

if ($_GET['type'] === 'questions' || $_GET['type'] === 'all')
{
    $questions = Question::getAllByCustomer($_SESSION['id'], true);
    $length = sizeof($questions);
    $i = 1;

    $json = "{\n\t\"questions\": [\n\n";
    /** @var Question $question */
    foreach ($questions as $question)
    {
        $name = $question->getName();
        $questionQ = $question->getQuestion();
        $answer = $question->getAnswer();

        $json .= "\t\t{\n";
        $json .= "\t\t\t\"id\": \"$name\" ,\n";
        $json .= "\t\t\t\"question\": \"$questionQ\",\n";
        $json .= "\t\t\t\"reponse\": \"$answer\" \n";
        $json .= "\t\t}" . ($i === $length ? "\n" : ",\n\n");
        ++$i;
    }
    $json .= "\t]\n}";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/Assets/Question.json', $json);
}

if ($_GET['type'] === 'surgeries' || $_GET['type'] === 'all')
{
    $surgeries = Surgery::getAllByCustomer($_SESSION['id'], true);
    $length = sizeof($surgeries);
    $i = 1;

    $json = "{\n\t\"chirurgies\": [\n\n";
    /** @var Surgery $surgery */
    foreach ($surgeries as $surgery)
    {
        $id = $surgery->getId();
        $name = $surgery->getName();

        $matsIds = $surgery->getMaterials();
        $surgeryMaterials = "[";
        $first = true;
        foreach ($matsIds as $materialId)
        {
            if ($first === false)
            {
                $surgeryMaterials .= ",";
            }
            else
            {
                $first = false;
            }
            $surgeryMaterials .= " " . $materialId;
        }
        $surgeryMaterials .= " ]";

        $surgeryResponses = $surgery->getResponses();
        $surgeryResponsesJson = "[";
        $first = true;
        foreach ($surgeryResponses as $response)
        {
            if ($first === false)
            {
                $surgeryResponsesJson .= ",";
            }
            else
            {
                $first = false;
            }
            $surgeryResponsesJson .= "\n\t\t\t\t{\"" . $response['questionName'] . "\": \"" . $response['answer'] . "\" }";
        }
        $surgeryResponsesJson .= ($surgeryResponsesJson === "[" ? "]" : "\n\t\t\t]");

        $compatibles = $surgery->getCompatibles();
        $patientsJson = "[";
        $first = true;
        foreach ($compatibles as $compatible)
        {
            if ($first === false)
            {
                $patientsJson .= ",";
            }
            else
            {
                $first = false;
            }
            $patientsJson .= " " . $compatible;
        }
        $patientsJson .= " ]";

        $spec = $surgery->getEmergency() === true ? '[ "urgence" ]' : '[]';
        $story = $surgery->getStory();


        $json .= "\t\t{\n";
        $json .= "\t\t\t\"id\": $id ,\n";
        $json .= "\t\t\t\"nom\": \"$name\",\n";
        $json .= "\t\t\t\"materiels\": $surgeryMaterials,\n";
        $json .= "\t\t\t\"reponses\": $surgeryResponsesJson,\n";
        $json .= "\t\t\t\"compatibles\": $patientsJson,\n";
        $json .= "\t\t\t\"spec\": $spec,\n";
        $json .= "\t\t\t\"histoire\": \"$story\",\n";
        $json .= "\t\t}" . ($i === $length ? "\n" : ",\n\n");
        ++$i;
    }
    $json .= "\t]\n}";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/Assets/Chirurgie.json', $json);
}

if ($_GET['type'] === 'patients' || $_GET['type'] === 'all')
{
    $patients = Patient::getAllByCustomer($_SESSION['id'], true);
    $length = sizeof($patients);
    $i = 1;

    $json = "{\n\t\"chirurgies\": [\n\n";
    /** @var Patient $patient */
    foreach ($patients as $patient)
    {
        $id = $patient->getId();
        $name = $patient->getLastname();
        $firstname = $patient->getFirstname();

        $sex = $patient->getSex();
        if ($sex === 0)
        {
            $sex = 'Homme';
        }
        else if ($sex === 1)
        {
            $sex = 'Femme';
        }
        else
        {
            $sex = 'Autre';
        }

        $age = $patient->getAge();
        $height = $patient->getHeight();
        $weight = $patient->getWeight();

        $matsIds = $patient->getMaterials();
        $patientMaterials = "[";
        $first = true;
        foreach ($matsIds as $materialId)
        {
            if ($first === false)
            {
                $patientMaterials .= ",";
            }
            else
            {
                $first = false;
            }
            $patientMaterials .= " " . $materialId;
        }
        $patientMaterials .= " ]";

        $patientResponses = $patient->getResponses();
        $patientResponsesJson = "[";
        $first = true;
        foreach ($patientResponses as $response)
        {
            if ($first === false)
            {
                $patientResponsesJson .= ",";
            }
            else
            {
                $first = false;
            }
            $patientResponsesJson .= "\n\t\t\t\t{\"" . $response['questionName'] . "\": \"" . $response['answer'] . "\" }";
        }
        $patientResponsesJson .= ($patientResponsesJson === "[" ? "]" : "\n\t\t\t]");

        $spec = "[]";

        $json .= "\t\t{\n";
        $json .= "\t\t\t\"id\": $id ,\n";
        $json .= "\t\t\t\"nom\": \"$name\",\n";
        $json .= "\t\t\t\"prenom\": \"$firstname\",\n";
        $json .= "\t\t\t\"sexe\": \"$sex\",\n";
        $json .= "\t\t\t\"age\": $age,\n";
        $json .= "\t\t\t\"taille\": $height,\n";
        $json .= "\t\t\t\"poid\": $weight,\n";
        $json .= "\t\t\t\"materiels\": $patientMaterials,\n";
        $json .= "\t\t\t\"reponses\": $patientResponsesJson,\n";
        $json .= "\t\t\t\"spec\": $spec\n";
        $json .= "\t\t}" . ($i === $length ? "\n" : ",\n\n");
        ++$i;
    }
    // TODO meme réponses pour tout les patients, normal ?
    $json .= "\t]\n}";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/Assets/Patient.json', $json);
}