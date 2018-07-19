<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 01/08/2017
 * Time: 17:44
 */

class Surgery extends DBA implements JsonSerializable
{
    private $id;
    private $idCustomer;
    private $name;
    private $materials;
    private $responses;
    private $compatibles;
    private $consultation;
    private $emergency;
    private $story;
    private $marProposition;
    private $marPropositionText;
    private $preAnestheticVisit;
    private $lastEval;

    public $jsonCustomer = false;

    public function __construct($dummy = false)
    {
        if (!$dummy)
            return;

        $this->name = '';
        $this->materials = [];
        $this->responses = [];
        $this->compatibles = [];
        $this->consultation = false;
        $this->emergency = false;
        $this->story = '';
        $this->marProposition = 0;
        $this->marPropositionText = '';
        $this->preAnestheticVisit = '';
        $this->lastEval = 0;
    }

    //<editor-fold desc="GetSets">

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
        $this->idCustomer = $idCustomer;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $mode
     * @return mixed
     */
    public function getMaterials($mode = '')
    {
        if ($mode === 'string')
        {
            $string = '';
            foreach ($this->materials as $material)
            {
                if (isset($material['name']) === false) { continue; }
                $string !== '' ? $string .= ', ' : null;
                $string += $material['name'];
            }
            return $string;
        }
        else
        {
            return $this->materials;
        }
    }

    /**
     * @param mixed $materials
     */
    public function setMaterials($materials)
    {
        if (!is_array($materials))
        {
            $materials = str_replace(' ', '', $materials);
            $materials = explode(',', $materials);
        }

        $this->materials = array();

        foreach ($materials as $material)
        {
            array_push($this->materials, intval($material));
        }

        //$this->materials = $materials;
    }

    /**
     * @return mixed
     */
    public function getResponses($mode = '')
    {
        return $this->responses;
    }

    /**
     * @param mixed $responses
     */
    public function setResponses($responses)
    {
        /*if (!is_array($responses))
        {
            $responses = str_replace(' ', '', $responses);
            $responses = explode(',', $responses);
        }

        $this->responses = array();

        foreach ($responses as $response)
        {
            array_push($this->responses, intval($response));
        }*/

        $this->responses = $responses;
    }

    /**
     * @return mixed
     */
    public function getCompatibles($mode = '')
    {
        return $this->compatibles;
    }

    /**
     * @param mixed $compatibles
     */
    public function setCompatibles($compatibles)
    {
        $this->compatibles = $compatibles;
    }

    /**
     * @return mixed
     */
    public function getEmergency()
    {
        return $this->emergency;
    }

    /**
     * @param mixed $emergency
     */
    public function setEmergency($emergency)
    {
        $this->emergency = $emergency;
    }

    /**
     * @return mixed
     */
    public function getStory()
    {
        return $this->story;
    }

    /**
     * @param mixed $story
     */
    public function setStory($story)
    {
        $this->story = $story;
    }

    /**
     * @return mixed
     */
    public function getConsultation()
    {
        return $this->consultation;
    }

    /**
     * @param mixed $consultation
     */
    public function setConsultation($consultation)
    {
        $this->consultation = $consultation;
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
     * @return string
     */
    public function getMarPropositionText()
    {
        return $this->marPropositionText;
    }

    /**
     * @param string $marPropositionText
     */
    public function setMarPropositionText($marPropositionText)
    {
        $this->marPropositionText = $marPropositionText;
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
    public function getLastEval()
    {
        return $this->lastEval;
    }

    /**
     * @param mixed $lastEval
     */
    public function setLastEval($lastEval)
    {
        $this->lastEval = $lastEval;
    }

    //</editor-fold>

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
            'name' => $this->name,
            'materials' => $this->materials,
            'responses' => $this->responses,
            'compatibles' => $this->compatibles,
            'consultation' => $this->consultation,
            'emergency' => $this->emergency,
            'story' => $this->story,
            'marProposition' => $this->marProposition,
            'marPropositionText' => $this->marPropositionText,
            'preAnestheticVisit' => $this->preAnestheticVisit,
            'lastEval' => $this->lastEval
        ];

        $this->jsonCustomer === true ? $json['idCustomer'] = $this->idCustomer : null;

        return $json;
    }

    //</editor-fold>

    //<editor-fold desc="Database writers">

    public function checkValidity($checkId = true)
    {
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

    public function save()
    {
        $query = self::query("SELECT * FROM `surgery` WHERE `id` = $this->id");
        $name = str_replace("'", "\'", $this->name);
        $story = str_replace("'", "\'", $this->story);
        $customer = $this->idCustomer;
        $consultation = $this->consultation === true ? '1' : '0';
        $emergency = $this->emergency === true ? '1' : '0';
        $marProposition = strval($this->marProposition);
        $marPropositionText = $this->marPropositionText;
        $preAnestheticVisit = $this->getPreAnestheticVisit();
        $lastEval = strval($this->getLastEval());

        if ($query->num_rows === 0 && $this->checkValidity(false))
        {
            $sql = "INSERT INTO `sgtools`.`surgery` (`idCustomer`, `name`, `consultation`, `emergency`, `story`, `marProposition`, `marPropositionText`, `preAnestheticVisit`, `lastEval`) VALUES
              ('$customer', '$name', '$consultation', '$emergency', '$story', $marProposition, '$marPropositionText', '$preAnestheticVisit', $lastEval);";
            $win = self::query($sql);
        }
        else if ($query->num_rows === 1 && $this->checkValidity())
        {
            $sql = "UPDATE `sgtools`.`surgery` SET `name`='$name', `consultation`='$consultation', `emergency`='$emergency', `story`='$story', `marProposition`='$marProposition', `marPropositionText`='$marPropositionText', `preAnestheticVisit`='$preAnestheticVisit', `lastEval`=$lastEval WHERE `id`=$this->id;";
            $win = self::query($sql);
        }
        else
        {
            return false;
        }

        $sql = '';

        //<editor-fold desc="Materials saving">

        $materials = self::query("SELECT * FROM `material_liaison` WHERE `idCustomer` = $customer && `spawnedBy` = 0 && `idSpawner` = $this->id")->fetch_all(MYSQLI_ASSOC);
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

                $sqlMaterials .= "(NULL, $customer, $matToSave, 0, $this->id)";
            }
        }
        if ($sqlMaterials !== '')
        {
            $sql .= "INSERT INTO `material_liaison` (`id`, `idCustomer`, `idMaterial`, `spawnedBy`, `idSpawner`) VALUES $sqlMaterials;\n";
        }

        // Delete materials non existant in new surgery
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
            $sql .= "DELETE FROM `material_liaison` WHERE $sqlMaterials `idCustomer` = $this->idCustomer && `spawnedBy` = 0 && `idSpawner` = $this->id;\n";
        }

        //</editor-fold>

        //<editor-fold desc="Questions saving">

        $questions = self::query("SELECT * FROM `questions_liaison` WHERE `spawnedBy` = 0 && `idSpawner` = $this->id")->fetch_all(MYSQLI_ASSOC);

        $questionsInDBA = array();
        foreach ($questions as $question)
        {
            array_push($questionsInDBA, intval($question['idQuestion']));
        }

        $questionsToSave = array();
        $responsesWithIndex = array();
        if ($this->responses == null)
        {
            $this->responses = array();
        }

        foreach ($this->responses as $response)
        {
            $responsesWithIndex[intval($response['id'])] = $response;
            array_push($questionsToSave, intval($response['id']));
        }

        // Add questions non existent in dba or update them
        $sqlQuestions = '';
        foreach ($questionsToSave as $questionToSave)
        {
            $answer = str_replace("'", "\'", $responsesWithIndex[$questionToSave]['answer']);

            if (in_array($questionToSave, $questionsInDBA))
            {
                $sql .= "UPDATE `questions_liaison` SET `answer` = '$answer' WHERE `idQuestion` = $questionToSave && `spawnedBy` = 0;\n";
            }
            else
            {
                if ($sqlQuestions !== '')
                {
                    $sqlQuestions .= ',';
                }

                $sqlQuestions .= "(NULL, $questionToSave, '$answer', $customer, 0, $this->id)";
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
            $sql .= "DELETE FROM `questions_liaison` WHERE  $sqlQuestions `spawnedBy` = 0 && `idSpawner` = $this->id;";
        }

        //</editor-fold>

        //<editor-fold desc="Patients saving">

            $patients = self::query("SELECT * FROM `patient_liaison` WHERE `idSurgery` = $this->id")->fetch_all(MYSQLI_ASSOC);
            $patientsInDBA = array();

            foreach ($patients as $patient)
            {
                array_push($patientsInDBA, intval($patient['idPatient']));
            }

            // Add patient non existent in dba
            $sqlPatients = '';
            foreach ($this->compatibles as $patientToSave)
            {
                if (in_array($patientToSave, $patientsInDBA) === false)
                {
                    if ($sqlPatients !== '')
                    {
                        $sqlPatients .= ',';
                    }

                    $sqlPatients .= "(NULL, $patientToSave, $customer, $this->id)";
                }
            }
            if ($sqlPatients !== '')
            {
                $sql .= "INSERT INTO `patient_liaison` (`id`, `idPatient`, `idCustomer`, `idSurgery`) VALUES $sqlPatients;\n";
            }

            // Delete patient non existant in new surgery
            $sqlPatients = '';
            foreach ($patientsInDBA as $patientToDelete)
            {
                if (in_array($patientToDelete, $this->compatibles) === false)
                {
                    if ($sqlPatients !== '')
                    {
                        $sqlPatients .= ' || ';
                    }
                    $sqlPatients .= "`idPatient` = $patientToDelete";
                }
            }
            if ($sqlPatients !== '')
            {
                $sql .= "DELETE FROM `patient_liaison` WHERE `idSurgery` = $this->id && ($sqlPatients);\n";
            }

            //</editor-fold>

        $win2 = true;
        if ($sql != '')
        {
            $win2 = self::mquery($sql);
        }

        return $win && $win2;
    }

    /**
     * Destroy surgery on the database
     * @return mixed
     */
    public function destroy()
    {
        if (self::query("DELETE FROM `surgery` WHERE `surgery`.`id` = $this->id") === true)
        {
            $sql = "DELETE FROM `material_liaison` WHERE `spawnedBy` = 0 && `idSpawner` = $this->id;\n";
            $sql .= "DELETE FROM `questions_liaison` WHERE `spawnedBy` = 0 && `idSpawner` = $this->id;\n";
            $sql .= "DELETE FROM `patient_liaison` WHERE `idSurgery` = $this->id;\n";

            return self::mquery($sql);
        }
        else
        {
            return false;
        }
    }

    //</editor-fold>

    //<editor-fold desc="Static database fetchers">

    /**
     * Get all patients with a defined customer id
     * @param $customerID
     * @return array|bool
     */
    public static function getAllByCustomer($customerID = 0, $indexId = false)
    {
        $patients = self::query("SELECT `id` FROM `surgery` WHERE `idCustomer` = $customerID")->fetch_all(MYSQLI_ASSOC);

        if ($patients === false)
        {
            return false;
        }

        $patientsWithInfos = array();

        foreach ($patients as $patient)
        {
            $newPatient = self::getById($patient['id']);

            if ($indexId === true)
            {
                $patientsWithInfos[$newPatient->getId()] = $newPatient;
            }
            else
            {
                array_push($patientsWithInfos, $newPatient);
            }
        }

        return $patientsWithInfos;
    }

    public static function getById($id = 0, $sortMatName = false)
    {
        $surgery = self::query("SELECT * FROM `surgery` WHERE `id` = $id")->fetch_array(MYSQLI_ASSOC);

        if ($surgery === null || $surgery === false)
        {
            return false;
        }

        $new_surgery = new Surgery();
        $new_surgery->setId(intval($surgery['id']));
        $new_surgery->setIdCustomer(intval($surgery['idCustomer']));
        $new_surgery->setName($surgery['name']);
        $new_surgery->setEmergency($surgery['emergency'] === '1' ? true : false);
        $new_surgery->setConsultation($surgery['consultation']);
        $new_surgery->setStory($surgery['story']);
        $new_surgery->setMarProposition($surgery['marProposition']);
        $new_surgery->setMarPropositionText($surgery['marPropositionText']);
        $new_surgery->setPreAnestheticVisit($surgery['preAnestheticVisit']);
        $new_surgery->setLastEval($surgery['lastEval']);


        if ($sortMatName)
            $sql = "SELECT ml.* FROM material_liaison ml JOIN material m ON m.id = ml.idMaterial WHERE ml.idSpawner = $id AND ml.spawnedBy = 0 ORDER BY m.name";
        else
            $sql = "SELECT `idMaterial` FROM `material_liaison` WHERE `spawnedBy` = 0 && `idSpawner` = $id";

        $materials = self::query($sql)->fetch_all(MYSQLI_ASSOC);
        $mat_array = array();
        foreach ($materials as $material)
        {
            array_push($mat_array, (int) $material['idMaterial']);
        }
        $new_surgery->setMaterials($mat_array);

        $questionsLinks = self::query("SELECT `idQuestion`, `answer` FROM `questions_liaison` WHERE `spawnedBy` = 0 && `idSpawner` = $id")->fetch_all(MYSQLI_ASSOC);
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
        $new_surgery->setResponses($questionsArray);

        $patients = self::query("SELECT `idPatient` FROM `patient_liaison` WHERE `idSurgery` = $id")->fetch_all(MYSQLI_ASSOC);
        $patients_array = array();
        foreach ($patients as $patient)
        {
            array_push($patients_array, (int) $patient['idPatient']);
        }
        $new_surgery->setCompatibles($patients_array);

        return $new_surgery;
    }

    /**
     * Get next id used by id sequence
     * @return int
     */
    public static function getNextId()
    {
        return intval(self::query('SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = \'surgery\'')->fetch_all(MYSQLI_ASSOC)[0]['auto_increment']);
    }

    /**
     * Get number of surgeries set by a customer
     * @param int $idCustomer
     * @return int
     */
    public static function getNumRowsByCustomer($idCustomer = 0)
    {
        return intval(self::query("SELECT COUNT(`id`) FROM `surgery` WHERE `idCustomer` = $idCustomer")->fetch_array()[0]);
    }

    //</editor-fold>
}