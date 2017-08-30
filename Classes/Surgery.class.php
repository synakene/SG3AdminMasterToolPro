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
    private $emergency;
    private $story;

    public $jsonCustomer = false;

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
            'emergency' => $this->emergency,
            'story' => $this->story,
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

        return true;
    }

    public function save()
    {
        $query = self::query("SELECT * FROM `surgery` WHERE `id` = $this->id");

        $name = str_replace("'", "\'", $this->name);
        $story = str_replace("'", "\'", $this->story);
        $customer = intval($_SESSION['id']);
        $emergency = $this->emergency === true ? '1' : '0';

        if ($query->num_rows === 0 && $this->checkValidity(false))
        {
            $win = self::query("INSERT INTO `surgery` (`id`, `idCustomer`, `name`, `emergency`, `story`) VALUES (NULL, $customer, '$name', $emergency, '$story');");
        }
        else if ($query->num_rows === 1 && $this->checkValidity())
        {
            $win = self::query("UPDATE `surgery` SET `name` = '$name', `emergency` = $emergency, `story` = '$story' WHERE `surgery`.`id` = $this->id");
        }
        else
        {
            return false;
        }

        $sql = '';

        //<editor-fold desc="Materials saving">

        // TODO dégommer id customer de la dba pour materiel_liaison
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
            $sql .= "DELETE FROM `material_liaison` WHERE $sqlMaterials `idCustomer` = 1 && `spawnedBy` = 0 && `idSpawner` = $this->id;\n";
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

                $sqlQuestions .= "(NULL, $questionToSave, '$answer', 0, $this->id)";
            }
        }

        if ($sqlQuestions !== '')
        {
            $sql .= "INSERT INTO `questions_liaison` (`id`, `idQuestion`, `answer`, `spawnedBy`, `idSpawner`) VALUES $sqlQuestions;\n";
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

                    $sqlPatients .= "(NULL, $patientToSave, $this->id)";
                }
            }
            if ($sqlPatients !== '')
            {
                $sql .= "INSERT INTO `patient_liaison` (`id`, `idPatient`, `idSurgery`) VALUES $sqlPatients;\n";
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

        return self::mquery($sql) && $win;
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

    public static function getById($id = 0)
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
        $new_surgery->setStory($surgery['story']);

        $materials = self::query("SELECT `idMaterial` FROM `material_liaison` WHERE `spawnedBy` = 0 && `idSpawner` = $id")->fetch_all(MYSQLI_ASSOC);
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