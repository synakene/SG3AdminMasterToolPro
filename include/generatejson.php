<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 28/08/2017
 * Time: 10:39
 */

include 'initializer.php';

$zip = new ZipArchive();
$fileName = "configuration.zip";

$userId = $_POST['id'];

if ($userId != $_SESSION['id'] && !$_SESSION['admin'])
{
    die('0');
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $fileName) === true)
{
    unlink($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $fileName);
}

if (!$zip->open($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $fileName, ZipArchive::CREATE))
{
    die('0');
}

if ($_POST['materials'] === 'true')
{
    $materials = Material::getAllByCustomer($userId, true);
    $length = sizeof($materials);
    $i = 1;

    $json = "{\n\t\"materiels\": [\n\n";
    foreach ($materials as $material)
    {
        $id = $material->getId();
        $name = $material->getName();
        $answer = $material->getCategory();

        $json .= "\t\t{\n";
        $json .= "\t\t\t\"id\": $id ,\n";
        $json .= "\t\t\t\"materiel\": \"$name\",\n";
        $json .= "\t\t\t\"cat\": \"$answer\" \n";
        $json .= "\t\t}" . ($i === $length ? "\n" : ",\n\n");
        ++$i;
    }
    $json .= "\t]\n}";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/streamingAssets/Materiel.json', $json);
    $zip->addFile($_SERVER['DOCUMENT_ROOT'] . '/assets/streamingAssets/Materiel.json', 'Materiel.json');
}

if ($_POST['questions'] === 'true')
{
    $questions = Question::getAllByCustomer($userId, true);
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
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/streamingAssets/Question.json', $json);
    $zip->addFile($_SERVER['DOCUMENT_ROOT'] . '/assets/streamingAssets/Question.json', 'Question.json');
}

if ($_POST['surgeries'] === 'true')
{
    $surgeries = Surgery::getAllByCustomer($userId, true);
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
        $story = json_encode($surgery->getStory());
        $consultation = $surgery->getConsultation() ? 'true' : 'false';
        $emergency = $surgery->getEmergency() ? 'true' : 'false';
        $marProposition = $surgery->getMarProposition();
        $marPropositionText = $surgery->getMarPropositionText();
        $preAnestheticVisit = str_replace('\n', '\\n', $surgery->getPreAnestheticVisit());
        $lastEval = $surgery->getLastEval();

        $json .= "\t\t{\n";
        $json .= "\t\t\t\"id\": $id ,\n";
        $json .= "\t\t\t\"nom\": \"$name\",\n";
        $json .= "\t\t\t\"materiels\": $surgeryMaterials,\n";
        $json .= "\t\t\t\"reponses\": $surgeryResponsesJson,\n";
        $json .= "\t\t\t\"compatibles\": $patientsJson,\n";
        $json .= "\t\t\t\"spec\": $spec,\n";
        $json .= "\t\t\t\"histoire\": $story,\n";
        $json .= "\t\t\t\"consultation\": $consultation,\n";
        $json .= "\t\t\t\"urgence\": $emergency,\n";
        $json .= "\t\t\t\"marProposition\": $marProposition,\n";
        $json .= "\t\t\t\"marPropositionText\": \"$marPropositionText\",\n";
        $json .= "\t\t\t\"preAnestheticVisit\": \"$preAnestheticVisit\",\n";
        $json .= "\t\t\t\"lastEval\": $lastEval\n";
        $json .= "\t\t}" . ($i === $length ? "\n" : ",\n\n");
        ++$i;
    }
    $json .= "\t]\n}";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/streamingAssets/Chirurgie.json', $json);
    $zip->addFile($_SERVER['DOCUMENT_ROOT'] . '/assets/streamingAssets/Chirurgie.json', 'Chirurgie.json');
}

if ($_POST['patients'] === 'true')
{
    $patients = Patient::getAllByCustomer($userId, true);
    $length = sizeof($patients);
    $i = 1;

    $json = "{\n\t\"patients\": [\n\n";
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
        $avatar = $patient->getAvatar();
        $story = json_encode($patient->getStory(), JSON_UNESCAPED_UNICODE);

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
        $avatar = $patient->getAvatar();
        $treatments = json_encode($patient->getTreatments(), JSON_UNESCAPED_UNICODE);

        $allergiesJson = $patient->getAllergies();
        $allergies = "[";
        foreach (json_decode($allergiesJson) as $allergy => $value)
        {
            if ($value)
                $allergies .= '"' . str_replace('"', '\\"', $allergy) . '", ';
        }
        if ($allergies !== "[")
            $allergies = substr($allergies, 0, strlen($allergies) - 2);

        $allergies .= "]";

        //$ta = $patient->getTa();
        $ta = json_encode($patient->getTa(), JSON_UNESCAPED_UNICODE);
        $fc = $patient->getFc();
        $examExtra = $patient->getExamExtra();

        $dentalCondition = json_encode($patient->getDentalCondition(), JSON_UNESCAPED_UNICODE);
        $dentalRiskNotice = $patient->getDentalRiskNotice() ? 'true' : 'false';
        $mallanpati = $patient->getMallanpati();
        $thyroidMentalDistance = $patient->getThyroidMentalDistance();
        $mouthOpening = $patient->getMouthOpening();
        $difficultIntubation = $patient->getDifficultIntubation() ? 'true' : 'false';
        $difficultVentilation = $patient->getDifficultVentilation() ? 'true' : 'false';
        $asa = $patient->getAsa();

        $preAnesthesicExaminationsJson = $patient->getPreAnestheticExaminations();
        //var_dump(json_decode($preAnesthesicExaminationsJson));
        $preAnesthesicExaminations = "[";
        foreach (json_decode($preAnesthesicExaminationsJson) as $examination => $value)
        {
            if ($value)
                $preAnesthesicExaminations .= json_encode($examination, JSON_UNESCAPED_UNICODE) . ", ";
        }
        if ($preAnesthesicExaminations != "[")
            $preAnesthesicExaminations = substr($preAnesthesicExaminations, 0, -2);

        $preAnesthesicExaminations .= "]";

        $marProposition = $patient->getMarProposition();
        $expectedHospitalisation = "Conventionnelle";
        if ($patient->getExpectedHospitalisation() === 1)
            $expectedHospitalisation = "Ambulatoire";
        else if ($patient->getExpectedHospitalisation() === 2)
            $expectedHospitalisation = "réa//SSIPO";

        $transfusionStrategy = json_encode($patient->getTransfusionStrategy(), JSON_UNESCAPED_UNICODE);
        $preAnestheticVisit = json_encode($patient->getPreAnestheticVisit(), JSON_UNESCAPED_UNICODE);
        $premedication = $patient->getPremedication();
        $premedicationExtra = $patient->getPremedicationExtra();

        $json .= "\t\t{\n";
        $json .= "\t\t\t\"id\": $id ,\n";
        $json .= "\t\t\t\"nom\": \"$name\",\n";
        $json .= "\t\t\t\"prenom\": \"$firstname\",\n";
        $json .= "\t\t\t\"sexe\": \"$sex\",\n";
        $json .= "\t\t\t\"age\": $age,\n";
        $json .= "\t\t\t\"taille\": $height,\n";
        $json .= "\t\t\t\"poids\": $weight,\n";
        $json .= "\t\t\t\"avatar\": $avatar,\n";
        $json .= "\t\t\t\"story\": $story,\n";
        $json .= "\t\t\t\"materiels\": $patientMaterials,\n";
        $json .= "\t\t\t\"reponses\": $patientResponsesJson,\n";
        $json .= "\t\t\t\"spec\": $spec,\n";
        $json .= "\t\t\t\"treatments\": $treatments,\n";
        $json .= "\t\t\t\"allergies\": $allergies,\n";
        //$json .= "\t\t\t\"ta\": \"$ta\",\n";
        $json .= "\t\t\t\"ta\": $ta,\n";
        $json .= "\t\t\t\"fc\": $fc,\n";
        $json .= "\t\t\t\"examExtra\": \"$examExtra\",\n";
        //$json .= "\t\t\t\"dentalCondition\": \"$dentalCondition\",\n";
        $json .= "\t\t\t\"dentalCondition\": $dentalCondition,\n";
        $json .= "\t\t\t\"dentalRiskNotice\": $dentalRiskNotice,\n";
        $json .= "\t\t\t\"mallanpati\": $mallanpati,\n";
        $json .= "\t\t\t\"thyroidMentalDistance\": $thyroidMentalDistance,\n";
        $json .= "\t\t\t\"mouthOpening\": $mouthOpening,\n";
        $json .= "\t\t\t\"difficultIntubation\": $difficultIntubation,\n";
        $json .= "\t\t\t\"difficultVentilation\": $difficultVentilation,\n";
        $json .= "\t\t\t\"asa\": $asa,\n";
        $json .= "\t\t\t\"preAnestheticExaminations\": $preAnesthesicExaminations,\n";
        $json .= "\t\t\t\"marProposition\": \"$marProposition\",\n";
        $json .= "\t\t\t\"expectedHospitalisation\": \"$expectedHospitalisation\",\n";
        $json .= "\t\t\t\"transfusionStrategy\": $transfusionStrategy,\n";
        $json .= "\t\t\t\"preAnestheticVisit\": $preAnestheticVisit,\n";
        $json .= "\t\t\t\"premedication\": $premedication,\n";
        $json .= "\t\t\t\"premedicationExtra\": \"$premedicationExtra\"\n";
        $json .= "\t\t}" . ($i === $length ? "\n" : ",\n\n");
        ++$i;
    }
    $json .= "\t]\n}";

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/streamingAssets/Patient.json', $json);
    $zip->addFile($_SERVER['DOCUMENT_ROOT'] . '/assets/streamingAssets/Patient.json', 'Patient.json');
}

file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/streamingAssets/sg3.txt', 'https://synabank.synakene.fr/api/v1/sg3/data');
$zip->addFile($_SERVER['DOCUMENT_ROOT'] . '/assets/streamingAssets/sg3.txt', 'sg3.txt');
file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/streamingAssets/sg4.txt', 'https://synabank.synakene.fr/api/v1/sg4/data');
$zip->addFile($_SERVER['DOCUMENT_ROOT'] . '/assets/streamingAssets/sg4.txt', 'sg4.txt');

$user = Customer::getById($userId);
file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/streamingAssets/key.txt', $user->getApiKey());
$zip->addFile($_SERVER['DOCUMENT_ROOT'] . '/assets/streamingAssets/key.txt', 'key.txt');

$zip->close();
die('1');