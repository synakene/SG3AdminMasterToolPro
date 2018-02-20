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
     * @param string $avatar
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
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'sex' => $this->sex,
            'age' => $this->age,
            'height' => $this->height,
            'weight' => $this->weight,
            'avatar' => $this->avatar,
            'story' => $this->story,
            'materials' => $this->materials,
            'surgeries' => $this->surgeries,
            'responses' => $this->responses,
        ];

        $this->jsonCustomer === true ? $json['idCustomer'] = $this->idCustomer : null;

        return $json;
    }

    //</editor-fold>


    //<editor-fold desc="Database writers">

    /**
     * Check validy for database writing.
     * Always use this function before writing !
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
    public function save($dummy = false)
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

        $lastname = $this->lastname;
        $firstname = $this->firstname;
        $this->story == null ? "" : $this->story;

        $customerId = $this->idCustomer;
        $sql = '';


        if ($rows === 0 && $this->checkValidity(false))
        {
            if ($dummy === true)
            {
                return self::query("INSERT INTO `patient` (`id`, `idCustomer`, `lastname`, `firstname`, `sex`, `age`, `height`, `weight`, `avatar`, `story`) VALUES (NULL, $customerId, '', '', 0, NULL, NULL, NULL, 1 , '');");
            }

            $win = self::query("INSERT INTO `patient` (`id`, `idCustomer`, `lastname`, `firstname`, `sex`, `age`, `height`, `weight`, `avatar`, `story`) VALUES (NULL, '$customerId', '$lastname', '$firstname', '$this->sex', '$this->age', '$this->height', '$this->weight', $this->avatar, '$this->story');");
        }
        else if ($rows === 1 && $this->checkValidity())
        {
            $win = self::query("UPDATE `patient` SET `lastname` = '$this->lastname', `firstname` = '$this->firstname', `sex` = $this->sex, `age` = $this->age, `height` = $this->height, `weight` = $this->weight, `avatar` = $this->avatar, `story` = '$this->story' WHERE `patient`.`id` = $this->id");
        }
        else
        {
            return false;
        }

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

                $sqlMaterials .= "(NULL, $customerId, $matToSave, 1, $this->id)";
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
            $sql .= "DELETE FROM `material_liaison` WHERE $sqlMaterials `idCustomer` = $customerId && `spawnedBy` = 1 && `idSpawner` = $this->id;\n";
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

                $sqlQuestions .= "(NULL, $questionToSave, '$answer', 1, $this->id)";
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

                $sqlSurgeries .= "(NULL, $this->id, $surgeryToSave)";
            }
        }
        if ($sqlSurgeries !== '')
        {
            $sql .= "INSERT INTO `patient_liaison` (`id`, `idPatient`, `idSurgery`) VALUES $sqlSurgeries;\n";
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
     * @return mixed
     */
    public static function getById($id = 0)
    {
        $query = self::query("SELECT * FROM `patient` WHERE `id` = $id")->fetch_array(MYSQLI_ASSOC);

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
        $patient->setStory(($query['story']));

        $materials = self::query("SELECT `idMaterial` FROM `material_liaison` WHERE `spawnedBy` = 1 && `idSpawner` = $id")->fetch_all(MYSQLI_ASSOC);
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
    public  static function getAvatarsByCustomer($idCustomer = 0)
    {
        $sql = "SELECT a.`id`, a.`name` FROM `avatars` a JOIN `patient` p ON a.`id` = p.`avatar` WHERE p.`idCustomer` = $idCustomer";
        return self::query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    //</editor-fold>
}