<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 01/08/2017
 * Time: 17:45
 */

class Patient extends DBA implements jsonSerializable
{
    private $id;
    private $idCustomer;
    private $lastname;
    private $firstname;
    private $sex;
    private $age;
    private $height;
    private $weight;
    private $avatar;

    private $story;
    private $treatments;
    private $allergies;
    private $ta;
    private $fc;
    private $examExtra;

    private $dentalCondition;
    private $dentalRiskNotice;
    private $mallanpati;
    private $thyroidMentalDistance;
    private $mouthOpening;
    private $difficultIntubation;
    private $difficultVentilation;
    private $asa;
    private $preAnestheticExaminations;
    private $marProposition;
    private $expectedHospitalisation;
    private $transfusionStrategy;
    private $preAnestheticVisit;

    private $premedication;
    private $premedicationExtra;

    private $feedback;

    private $materials;
    private $surgeries;
    private $responses;

    public $jsonCustomer = false;

    //<editor-fold desc="GetSet">

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdCustomer()
    {
        return $this->idCustomer;
    }

    /**
     * @param mixed $idCustomer
     */
    public function setIdCustomer($idCustomer)
    {
        $idCustomer = intval($idCustomer);
        if ($idCustomer < 0)
            $idCustomer = 0;

        $this->idCustomer = $idCustomer;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param mixed $sex
     */
    public function setSex($sex)
    {
        $sex = intval($sex);
        if ($sex < 0 || $sex > 2)
        {
            $sex = 2;
        }
        $this->sex = $sex;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $age = intval($age);
        if ($age < 0 || $age > 255)
        {
            $age = 0;
        }
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $height = intval($height);
        if ($height < 0 || $height > 1000)
        {
            $height = 0;
        }
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param int|string $avatar
     */
    public function setAvatar($avatar = 0)
    {
        $avatar = intval($avatar);
        if ($avatar < 0)
            $avatar = 0;

        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight)
    {
        $weight = intval($weight);
        if ($weight < 0 || $weight > 1000)
        {
            $weight = 0;
        }
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getStory()
    {
        return $this->story;
    }

    /**
     * @param string $story
     */
    public function setStory($story)
    {
        $this->story = $story;
    }

    /**
     * @return mixed
     */
    public function getMaterials()
    {
        return $this->materials;
    }

    /**
     * @param mixed $materials
     */
    public function setMaterials($materials)
    {
        $this->materials = $materials;
    }

    /**
     * @return mixed
     */
    public function getSurgeries()
    {
        return $this->surgeries;
    }

    /**
     * @param mixed $surgeries
     */
    public function setSurgeries($surgeries)
    {
        $this->surgeries = $surgeries;
    }

    /**
     * @return mixed
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @param mixed $responses
     */
    public function setResponses($responses)
    {
        $this->responses = $responses;
    }

    /**
     * @return mixed
     */
    public function getTreatments()
    {
        return $this->treatments;
    }

    /**
     * @param mixed $treatments
     */
    public function setTreatments($treatments)
    {
        $this->treatments = $treatments;
    }

    /**
     * @return mixed
     */
    public function getAllergies()
    {
        return $this->allergies;
    }

    /**
     * @param mixed $allergies
     */
    public function setAllergies($allergies)
    {
        $this->allergies = $allergies;
    }

    /**
     * @return mixed
     */
    public function getTa()
    {
        return $this->ta;
    }

    /**
     * @param mixed $ta
     */
    public function setTa($ta)
    {
        $this->ta = $ta;
    }

    /**
     * @return mixed
     */
    public function getFc()
    {
        return $this->fc;
    }

    /**
     * @param mixed $fc
     */
    public function setFc($fc)
    {
        $this->fc = $fc;
    }

    /**
     * @return mixed
     */
    public function getDentalCondition()
    {
        return $this->dentalCondition;
    }

    /**
     * @param mixed $dentalCondition
     */
    public function setDentalCondition($dentalCondition)
    {
        $this->dentalCondition = $dentalCondition;
    }

    /**
     * @return mixed
     */
    public function getDentalRiskNotice()
    {
        return $this->dentalRiskNotice;
    }

    /**
     * @param mixed $dentalRiskNotice
     */
    public function setDentalRiskNotice($dentalRiskNotice)
    {
        $this->dentalRiskNotice = $dentalRiskNotice;
    }

    /**
     * @return mixed
     */
    public function getMallanpati()
    {
        return $this->mallanpati;
    }

    /**
     * @param mixed $mallanpati
     */
    public function setMallanpati($mallanpati)
    {
        $this->mallanpati = $mallanpati;
    }

    /**
     * @return mixed
     */
    public function getThyroidMentalDistance()
    {
        return $this->thyroidMentalDistance;
    }

    /**
     * @param mixed $thyroidMentalDistance
     */
    public function setThyroidMentalDistance($thyroidMentalDistance)
    {
        $this->thyroidMentalDistance = $thyroidMentalDistance;
    }

    /**
     * @return mixed
     */
    public function getMouthOpening()
    {
        return $this->mouthOpening;
    }

    /**
     * @param mixed $mouthOpening
     */
    public function setMouthOpening($mouthOpening)
    {
        $this->mouthOpening = $mouthOpening;
    }

    /**
     * @return mixed
     */
    public function getDifficultIntubation()
    {
        return $this->difficultIntubation;
    }

    /**
     * @param mixed $difficultIntubation
     */
    public function setDifficultIntubation($difficultIntubation)
    {
        $this->difficultIntubation = $difficultIntubation;
    }

    /**
     * @return mixed
     */
    public function getDifficultVentilation()
    {
        return $this->difficultVentilation;
    }

    /**
     * @param mixed $difficultVentilation
     */
    public function setDifficultVentilation($difficultVentilation)
    {
        $this->difficultVentilation = $difficultVentilation;
    }

    /**
     * @return mixed
     */
    public function getAsa()
    {
        return $this->asa;
    }

    /**
     * @param mixed $asa
     */
    public function setAsa($asa)
    {
        $this->asa = $asa;
    }

    /**
     * @return mixed
     */
    public function getPreAnestheticExaminations($escapeDoubleQuote = false)
    {
        return $this->preAnestheticExaminations;
    }

    /**
     * @param mixed $preAnestheticExaminations
     */
    public function setPreAnestheticExaminations($preAnestheticExaminations)
    {
        $this->preAnestheticExaminations = $preAnestheticExaminations;
    }

    /**
     * @return mixed
     */
    public function getMarProposition()
    {
        return $this->marProposition;
    }

    /**
     * @param mixed $marProposition
     */
    public function setMarProposition($marProposition)
    {
        $this->marProposition = $marProposition;
    }

    /**
     * @return mixed
     */
    public function getExpectedHospitalisation()
    {
        return $this->expectedHospitalisation;
    }

    /**
     * @param mixed $expectedHospitalisation
     */
    public function setExpectedHospitalisation($expectedHospitalisation)
    {
        $this->expectedHospitalisation = $expectedHospitalisation;
    }

    /**
     * @return mixed
     */
    public function getTransfusionStrategy()
    {
        return $this->transfusionStrategy;
    }

    /**
     * @param mixed $transfusionStrategy
     */
    public function setTransfusionStrategy($transfusionStrategy)
    {
        $this->transfusionStrategy = $transfusionStrategy;
    }

    /**
     * @return mixed
     */
    public function getPreAnestheticVisit()
    {
        return $this->preAnestheticVisit;
    }

    /**
     * @param mixed $preAnestheticVisit
     */
    public function setPreAnestheticVisit($preAnestheticVisit)
    {
        $this->preAnestheticVisit = $preAnestheticVisit;
    }

    /**
     * @return mixed
     */
    public function getPremedication()
    {
        return $this->premedication;
    }

    /**
     * @param mixed $premedication
     */
    public function setPremedication($premedication)
    {
        $this->premedication = $premedication;
    }

    /**
     * @return mixed
     */
    public function getExamExtra()
    {
        return $this->examExtra;
    }

    /**
     * @param mixed $examExtra
     */
    public function setExamExtra($examExtra)
    {
        $this->examExtra = $examExtra;
    }

    /**
     * @return mixed
     */
    public function getPremedicationExtra()
    {
        return $this->premedicationExtra;
    }

    /**
     * @param mixed $premedicationExtra
     */
    public function setPremedicationExtra($premedicationExtra)
    {
        $this->premedicationExtra = $premedicationExtra;
    }

    /**
     * @return string
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * @param string $feedback
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;
    }

    //</editor-fold>

    public function __construct($dummy = false)
    {
        if ($dummy === true)
        {
            $this->idCustomer = 0;
            $this->lastname = '';
            $this->firstname = '';
            $this->sex = 0;
            $this->age = 0;
            $this->height = 0;
            $this->weight = 0;
            $this->avatar = 0;
            $this->story = '';
            $this->treatments = '';
            $this->allergies = '{}';
            $this->ta = '0/0';
            $this->fc = 0;
            $this->examExtra = '';

            $this->dentalCondition = '';
            $this->dentalRiskNotice = false;
            $this->mallanpati = 1;
            $this->thyroidMentalDistance = 0;
            $this->mouthOpening = 0;
            $this->difficultIntubation = false;
            $this->difficultVentilation = false;
            $this->asa = 1;
            $this->preAnestheticExaminations = '{}';
            $this->marProposition = 0;
            $this->expectedHospitalisation = 0;
            $this->transfusionStrategy = '';
            $this->preAnestheticVisit = '';

            $this->premedication = '{"eve":[], "morning":[]}';
            $this->premedicationExtra = '';

            $this->feedback = "";
        }
    }

    //<editor-fold desc="Utilities">

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        $json = [
            'id' => $this->id,
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'sex' => $this->sex,
            'age' => $this->age,
            'height' => $this->height,
            'weight' => $this->weight,
            'avatar' => $this->avatar,
            'materials' => $this->materials,
            'surgeries' => $this->surgeries,
            'responses' => $this->responses,
            'story' => $this->getStory(),
            'treatments' => $this->getTreatments(),
            'allergies' => $this->getAllergies(),
            'ta' => $this->getTa(),
            'fc' => $this->getFc(),
            'examExtra' => $this->getExamExtra(),
            'dentalCondition' => $this->getDentalCondition(),
            'dentalRiskNotice' => $this->getDentalRiskNotice(),
            'mallanpati' => $this->getMallanpati(),
            'thyroidMentalDistance' => $this->getThyroidMentalDistance(),
            'mouthOpening' => $this->getMouthOpening(),
            'difficultIntubation' => $this->getDifficultIntubation(),
            'difficultVentilation' => $this->getDifficultVentilation(),
            'asa' => $this->getAsa(),
            'preAnestheticExaminations' => $this->getPreAnestheticExaminations(),
            'marProposition' => $this->getMarProposition(),
            'expectedHospitalisation' => $this->getExpectedHospitalisation(),
            'transfusionStrategy' => $this->getTransfusionStrategy(),
            'preAnestheticVisit' => $this->getPreAnestheticVisit(),
            'premedication' => $this->getPremedication(),
            'premedicationExtra' => $this->getPremedicationExtra(),
            'feedback' => $this->getFeedback(),
        ];

        $this->jsonCustomer === true ? $json['idCustomer'] = $this->idCustomer : null;

        return $json;
    }

    //</editor-fold>


    //<editor-fold desc="Database writers">

    /**
     * Check validy for database writing.
     * Always use this function before writing !
     * @param bool $checkId
     * @return bool
     */
    public function checkValidity($checkId = true)
    {
        // TODO faire les checkvalidity de toutes les classes
        if ($checkId === true && $this->id === 0)
        {
            return false;
        }

        if ($this->idCustomer === 0)
        {
            return false;
        }

        if ($this->idCustomer != $_SESSION['id'] && !$_SESSION['admin'])
        {
            return false;
        }

        return true;
    }

    /**
     * Save the object to the database
     * @return boolean
     */
    public function save()
    {
        $sql = "SELECT * FROM `patient` WHERE `id` = $this->id";
        $query = self::query($sql);
        if ($query)
        {
            $rows = $query->num_rows;
            $query->close();
        }
        else
        {
            return false;
        }

        $id = $this->getId();
        $idCustomer = $this->getIdCustomer();
        $lastname = $this->getLastname();
        $firstname = $this->getFirstname();
        $sex = $this->getSex();
        $age = $this->getAge();
        $height = $this->getHeight();
        $weight = $this->getWeight();
        $avatar = $this->getAvatar();
        $story = $this->getStory();
        $treatments = $this->getTreatments();
        $allergies = $this->getAllergies();
        $ta = $this->getTa();
        $fc = $this->getFc();
        $examExtra = $this->getExamExtra();

        $dentalCondition = $this->getDentalCondition();
        $dentalRiskNotice = filter_var($this->getDentalRiskNotice(), FILTER_VALIDATE_BOOLEAN) ? '1' : '0';
        $mallanpati = $this->getMallanpati();
        $thyroidMentalDistance = $this->getThyroidMentalDistance();
        $mouthOpening = $this->getMouthOpening();
        $difficultIntubation = filter_var($this->getDifficultIntubation(), FILTER_VALIDATE_BOOLEAN) ? '1' : '0';
        $difficultVentilation = filter_var($this->getDifficultVentilation(), FILTER_VALIDATE_BOOLEAN) ? '1' : '0';
        $asa = $this->getAsa();
        $preAnestheticExaminations = $this->getPreAnestheticExaminations();
        ///$preAnestheticExaminations = str_replace('\\"', '\\\\"', $preAnestheticExaminations);
        $marProposition = $this->getMarProposition();

        $expectedHospitalisation = $this->getExpectedHospitalisation();
        if (is_string($expectedHospitalisation))
        {
            if (strtolower($expectedHospitalisation) == "réa/ssipo")
                $expectedHospitalisation = 2;
            else if (strtolower($expectedHospitalisation) == "ambulatoire")
                $expectedHospitalisation = 1;
            else
                $expectedHospitalisation = 0;
        }

        $transfusionStrategy = $this->getTransfusionStrategy();
        $preAnestheticVisit = $this->getPreAnestheticVisit();
        $premedication = $this->getPremedication();
        $premedicationExtra = $this->getPremedicationExtra();
        $feedback = $this->getFeedback();

        if ($rows === 0 && $this->checkValidity(false)) // new patient
        {
            $sql = "INSERT INTO `sgtools`.`patient` (`idCustomer`, `lastname`, `firstname`, `sex`, `age`, `height`, `weight`, `avatar`, `story`, `treatments`, `allergies`, `ta`, `fc`, `dentalCondition`, `dentalRiskNotice`, `mallanpati`, `thyroidMentalDistance`, `mouthOpening`, `difficultIntubation`, `difficultVentilation`, `asa`, `preAnestheticExaminations`, `marProposition`, `expectedHospitalisation`, `transfusionStrategy`, `preAnestheticVisit`, `premedication`, `examExtra`, `premedicationExtra`, `feedback`) VALUES (" .
            "'$idCustomer', '$lastname', '$firstname', $sex, $age, $height, $weight, $avatar, '$story', '$treatments', '$allergies', '$ta', $fc, '$dentalCondition', $dentalRiskNotice, '$mallanpati', '$thyroidMentalDistance', '$mouthOpening', '$difficultIntubation', '$difficultVentilation', $asa, '$preAnestheticExaminations', $marProposition, $expectedHospitalisation, '$transfusionStrategy', '$preAnestheticVisit', '$premedication', '$examExtra', '$premedicationExtra', '$feedback');";

            $win = self::query($sql);
        }
        else if ($rows === 1 && $this->checkValidity()) // update existing patient
        {
            $sql = "UPDATE `sgtools`.`patient` SET".
                " `idCustomer`='$idCustomer', ".
                "`lastname`='$lastname', ".
                "`firstname`='$firstname', ".
                "`sex`='$sex', ".
                "`age`='$age', ".
                "`height`='$height', ".
                "`weight`='$weight', ".
                "`avatar`='$avatar', ".
                "`story`='$story', ".
                "`treatments`='$treatments', ".
                "`allergies`='$allergies', ".
                "`ta`='$ta', ".
                "`fc`='$fc', ".
                "`dentalCondition`='$dentalCondition', ".
                "`dentalRiskNotice`='$dentalRiskNotice', ".
                "`mallanpati`='$mallanpati', ".
                "`thyroidMentalDistance`='$thyroidMentalDistance', ".
                "`mouthOpening`='$mouthOpening', ".
                "`difficultIntubation`='$difficultIntubation', ".
                "`difficultVentilation`='$difficultVentilation', ".
                "`asa`='$asa', ".
                "`preAnestheticExaminations`='$preAnestheticExaminations', ".
                "`marProposition`='$marProposition', ".
                "`expectedHospitalisation`='$expectedHospitalisation', ".
                "`transfusionStrategy`='$transfusionStrategy', ".
                "`preAnestheticVisit`='$preAnestheticVisit', ".
                "`premedication`='$premedication', ".
                "`examExtra`='$examExtra', ".
                "`premedicationExtra`='$premedicationExtra', ".
                "`feedback`='$feedback' ".
                "WHERE `id`=$id;";

            $win = self::query($sql);
        }
        else // patient not found and/or not valid
        {
            return false;
        }

        $sql = '';

        //<editor-fold desc="Materials saving">

        $materials = self::query("SELECT * FROM `material_liaison` WHERE `spawnedBy` = 1 && `idSpawner` = $this->id")->fetch_all(MYSQLI_ASSOC);
        $materialsInDBA = array();

        foreach ($materials as $material)
        {
            array_push($materialsInDBA, intval($material['idMaterial']));
        }

        // Add materials non existent in dba
        $sqlMaterials = '';
        foreach ($this->materials as $matToSave)
        {
            if (in_array($matToSave, $materialsInDBA) === false)
            {
                if ($sqlMaterials !== '')
                {
                    $sqlMaterials .= ',';
                }

                $sqlMaterials .= "(NULL, $idCustomer, $matToSave, 1, $this->id)";
            }
        }
        if ($sqlMaterials !== '')
        {
            $sql .= "INSERT INTO `material_liaison` (`id`, `idCustomer`, `idMaterial`, `spawnedBy`, `idSpawner`) VALUES $sqlMaterials;\n";
        }

        // Delete materials non existant in new patient
        $sqlMaterials = '';
        foreach ($materialsInDBA as $matToDelete)
        {
            if (in_array($matToDelete, $this->materials) === false)
            {
                if ($sqlMaterials !== '')
                {
                    $sqlMaterials .= ' || ';
                }
                $sqlMaterials .= "`idMaterial` = $matToDelete";
            }
        }
        if ($sqlMaterials !== '')
        {
            $sqlMaterials = '(' . $sqlMaterials . ') &&';
            $sql .= "DELETE FROM `material_liaison` WHERE $sqlMaterials `idCustomer` = $this->idCustomer && `spawnedBy` = 1 && `idSpawner` = $this->id;\n";
        }

        //</editor-fold>

        //<editor-fold desc="Questions saving">

        $questions = self::query("SELECT * FROM `questions_liaison` WHERE `spawnedBy` = 1 && `idSpawner` = $this->id")->fetch_all(MYSQLI_ASSOC);

        $questionsInDBA = array();
        foreach ($questions as $question)
        {
            array_push($questionsInDBA, intval($question['idQuestion']));
        }

        $questionsToSave = array();
        $responsesWithIndex = array();
        foreach ($this->responses as $response)
        {
            $responsesWithIndex[intval($response['id'])] = $response;
            array_push($questionsToSave, intval($response['id']));
        }

        // Add questions non existent in dba or update them
        $sqlQuestions = '';
        foreach ($questionsToSave as $questionToSave)
        {
            //$answer = str_replace("'", "\'", $responsesWithIndex[$questionToSave]['answer']);
            $answer = $responsesWithIndex[$questionToSave]['answer'];

            if (in_array($questionToSave, $questionsInDBA))
            {
                $sql .= "UPDATE `questions_liaison` SET `answer` = '$answer' WHERE `idQuestion` = $questionToSave && `spawnedBy` = 1 && `idSpawner` = $this->id;\n";
            }
            else
            {
                if ($sqlQuestions !== '')
                {
                    $sqlQuestions .= ',';
                }

                $sqlQuestions .= "(NULL, $questionToSave, '$answer', $this->idCustomer, 1, $this->id)";
            }
        }

        if ($sqlQuestions !== '')
        {
            $sql .= "INSERT INTO `questions_liaison` (`id`, `idQuestion`, `answer`, `idCustomer`, `spawnedBy`, `idSpawner`) VALUES $sqlQuestions;\n";
        }

        // Delete questions non existent in new surgery
        $sqlQuestions = '';
        foreach ($questionsInDBA as $questionToDelete)
        {
            if (in_array($questionToDelete, $questionsToSave) === false)
            {
                if ($sqlQuestions !== '')
                {
                    $sqlQuestions .= ' || ';
                }
                $sqlQuestions .= "`idQuestion` = $questionToDelete";
            }
        }
        if ($sqlQuestions !== '')
        {
            $sqlQuestions = '(' . $sqlQuestions . ') &&';
            $sql .= "DELETE FROM `questions_liaison` WHERE  $sqlQuestions `spawnedBy` = 1 && `idSpawner` = $this->id;";
        }

        //</editor-fold>

        //<editor-fold desc="Surgeries saving">

        $query = self::query("SELECT * FROM `patient_liaison` WHERE `idPatient` = $this->id");
        if (!$query)
        {
            return false;
        }

        $surgeries = $query->fetch_all(MYSQLI_ASSOC);
        $query->close();

        $surgeriesInDba = array();
        if (!isset($this->surgeries))
        {
            $this->surgeries = array();
        }

        foreach ($surgeries as $surgery)
        {
            array_push($surgeriesInDba, intval($surgery['idSurgery']));
        }

        // Add surgeries non existent in dba
        $sqlSurgeries = '';
        foreach ($this->surgeries as $surgeryToSave)
        {
            if (in_array($surgeryToSave, $surgeriesInDba) === false)
            {
                if ($sqlSurgeries !== '')
                {
                    $sqlSurgeries .= ',';
                }

                $sqlSurgeries .= "(NULL, $this->id, $this->idCustomer, $surgeryToSave)";
            }
        }
        if ($sqlSurgeries !== '')
        {
            $sql .= "INSERT INTO `patient_liaison` (`id`, `idPatient`, `idCustomer`, `idSurgery`) VALUES $sqlSurgeries;\n";
        }

        // Delete surgeries non existant in new patient
        $sqlSurgeries = '';
        foreach ($surgeriesInDba as $surgeriesToDelete)
        {
            if (in_array($surgeriesToDelete, $this->surgeries) === false)
            {
                if ($sqlSurgeries !== '')
                {
                    $sqlSurgeries .= ' || ';
                }
                $sqlSurgeries .= "`idSurgery` = $surgeriesToDelete";
            }
        }
        if ($sqlSurgeries !== '')
        {
            $sql .= "DELETE FROM `patient_liaison` WHERE `idPatient` = $this->id && ($sqlSurgeries);\n";
        }

        //</editor-fold>

        if ($sql === '')
        {
            return $win;
        }
        else
        {
            return self::mquery($sql) && $win;
        }
    }

    /**
     * Destroy
     * @return mixed
     */
    public function destroy()
    {
        if (self::query("DELETE FROM `patient` WHERE `patient`.`id` = $this->id") === true)
        {
            $sql = "DELETE FROM `material_liaison` WHERE `spawnedBy` = 1 && `idSpawner` = $this->id;\n";
            $sql .= "DELETE FROM `questions_liaison` WHERE `spawnedBy` = 1 && `idSpawner` = $this->id;\n";
            $sql .= "DELETE FROM `patient_liaison` WHERE `idPatient` = $this->id;\n";

            return self::mquery($sql);
        }
        else
        {
            return false;
        }
    }

    /**
     * Save or update avatar
     * Admin tool
     * @param int $id
     * @param string $name
     * @param int $pack
     * @return mixed
     */
    public static function saveAvatar($id = 0, $name = '', $pack = 0)
    {
        if (self::query("SELECT `id` FROM `avatars` WHERE `id` = $id")->num_rows === 1)
        {
            return self::query("UPDATE `avatars` SET `name` = '$name', `pack` = $pack WHERE `avatars`.`id` = $id");
        }
        else
        {
            return self::query("INSERT INTO `avatars` (`id`, `name`, `pack`) VALUES (NULL, '$name', '$pack')");
        }
    }

    //</editor-fold>


    //<editor-fold desc="Static database fetchers">

    /**
     * Return a question by id
     * @param int $id
     * @param bool $sortMaterialsByName
     * @return mixed
     */
    public static function getById($id = 0, $sortMaterialsByName = false)
    {
        $sql = "SELECT * FROM `patient` WHERE `id` = $id";
        $query = self::query($sql)->fetch_array(MYSQLI_ASSOC);

        if (sizeof($query) === 0)
        {
            return false;
        }

        $patient = new Patient();

        $patient->setId($query['id']);
        $patient->setIdCustomer($query['idCustomer']);
        $patient->setLastname($query['lastname']);
        $patient->setFirstname($query['firstname']);
        $patient->setSex($query['sex']);
        $patient->setAge($query['age']);
        $patient->setHeight($query['height']);
        $patient->setWeight($query['weight']);
        $patient->setAvatar($query['avatar']);

        $patient->setStory($query['story']);
        $patient->setTreatments($query['treatments']);
        $patient->setAllergies($query['allergies']);
        $patient->setTa($query['ta']);
        $patient->setFc($query['fc']);
        $patient->setExamExtra($query['examExtra']);

        $patient->setDentalCondition($query['dentalCondition']);
        $patient->setDentalRiskNotice($query['dentalRiskNotice'] == '1' ? true : false);
        $patient->setMallanpati($query['mallanpati']);
        $patient->setThyroidMentalDistance($query['thyroidMentalDistance']);
        $patient->setMouthOpening($query['mouthOpening']);
        $patient->setDifficultIntubation($query['difficultIntubation'] == '1' ? true : false);
        $patient->setDifficultVentilation($query['difficultVentilation'] == '1' ? true : false);
        $patient->setAsa($query['asa']);
        $patient->setPreAnestheticExaminations($query['preAnestheticExaminations']);
        $patient->setMarProposition($query['marProposition']);
        $patient->setExpectedHospitalisation($query['expectedHospitalisation']);
        $patient->setTransfusionStrategy($query['transfusionStrategy']);
        $patient->setPreAnestheticVisit($query['preAnestheticVisit']);

        $patient->setPremedication($query['premedication']);
        $patient->setPremedicationExtra($query['premedicationExtra']);

        $patient->setFeedback($query['feedback']);

        if ($sortMaterialsByName)
            $sql = "SELECT `idMaterial` FROM `material_liaison` ml JOIN material m ON m.id = ml.idMaterial WHERE `spawnedBy` = 1 && `idSpawner` = $id ORDER BY m.name";
        else
            $sql = "SELECT `idMaterial` FROM `material_liaison` WHERE `spawnedBy` = 1 && `idSpawner` = $id";

        $materials = self::query($sql)->fetch_all(MYSQLI_ASSOC);
        $mat_array = array();
        foreach ($materials as $material)
        {
            array_push($mat_array, (int) $material['idMaterial']);
        }
        $patient->setMaterials($mat_array);

        $questionsLinks = self::query("SELECT `idQuestion`, `answer` FROM `questions_liaison` WHERE `spawnedBy` = 1 && `idSpawner` = $id")->fetch_all(MYSQLI_ASSOC);
        $questionsArray = array();

        foreach ($questionsLinks as $questionLink)
        {
            $questionId = $questionLink['idQuestion'];
            $question = self::query("SELECT `name`, `answer` FROM `questions` WHERE `id` = $questionId")->fetch_array(MYSQLI_ASSOC);
            array_push($questionsArray, array(
                'id' => (int) $questionId,
                'questionName' => $question['name'],
                'defaultAnswer' => $question['answer'],
                'answer' => $questionLink['answer'],
            ));
        }

        $patient->setResponses($questionsArray);

        $surgeries = self::query("SELECT `idSurgery` FROM `patient_liaison` WHERE `idPatient` = $id")->fetch_all(MYSQLI_ASSOC);

        $surgeriesArray = array();
        foreach ($surgeries as $surgery)
        {
            array_push($surgeriesArray, (int) $surgery['idSurgery']);
        }

        $patient->setSurgeries($surgeriesArray);

        return $patient;
    }

    /**
     * Get all questions by customer id
     * @param int $idCustomer
     * @return mixed
     */
    public static function getAllByCustomer($idCustomer = 0, $indexId = false)
    {
        $query = self::query("SELECT * FROM `patient` WHERE `idCustomer` = $idCustomer")->fetch_all(MYSQLI_ASSOC);
        $patients = array();

        foreach ($query as $patient)
        {
            if ($indexId === true)
            {
                $patients[$patient['id']] = self::getById($patient['id']);
            }
            else
            {
                array_push($patients, self::getById($patient['id']));
            }
        }

        return $patients;
    }

    /**
     * Get next id used by id sequence
     * @return int
     */
    public static function getNextId()
    {
        return intval(self::query('SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = \'patient\'')->fetch_all(MYSQLI_ASSOC)[0]['auto_increment']);
    }

    /**
     * Get number of patients set by a customer
     * @param int $idCustomer
     * @return int
     */
    public static function getNumRowsByCustomer($idCustomer = 0)
    {
        return intval(self::query("SELECT COUNT(`id`) FROM `patient` WHERE `idCustomer` = $idCustomer")->fetch_array()[0]);
    }

    /**
     * Return names of avatars ordered by patients
     * @param int $idCustomer
     * @return mixed
     */
    public  static function getAvatarsByCustomer($idCustomer = 0, $indexId = false)
    {
        $sql = "SELECT a.`id`, a.`name` FROM `avatars` a JOIN `patient` p ON a.`id` = p.`avatar` WHERE p.`idCustomer` = $idCustomer";
        $data = self::query($sql)->fetch_all(MYSQLI_ASSOC);

        if ($indexId)
        {
            $avatars = array();
            foreach ($data as $avatar)
            {
                $avatars[$avatar['id']] = $avatar;
            }
            return $avatars;
        }

        return $data;
    }

    //</editor-fold>
}