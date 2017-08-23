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
    private $materials;
    private $surgeries;
    private $responses;

    public $jsonCustomer = false;

    public function __construct()
    {

    }

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
        $this->height = $height;
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
        $this->weight = $weight;
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

        return true;
    }

    /**
     * Save the object to the database
     * @return boolean
     */
    public function save()
    {
        // TODO
        $query = self::query("SELECT * FROM `patient` WHERE `id` = $this->id");

        $lastname = str_replace("'", "\'", $this->lastname);
        $firstname = str_replace("'", "\'", $this->firstname);

        if ($query->num_rows === 0 && $this->checkValidity(false))
        {
            return self::query("INSERT INTO `questions` (`id`, `idCustomer`, `name`, `question`, `answer`) VALUES (NULL, $this->idCustomer, '$name', '$question', '$answer');");
        }
        else if ($query->num_rows === 1 && $this->checkValidity())
        {
            return self::query("UPDATE `questions` SET `idCustomer` = $this->idCustomer, `name` = '$name', `question` = '$question', `answer` = '$answer' WHERE `questions`.`id` = $this->id;");
        }
        else
        {
            return false;
        }
    }

    /**
     * Destroy
     * @return mixed
     */
    public function destroy()
    {
        // TODO
        return self::query("DELETE FROM `questions` WHERE `questions`.`id` = $this->id");
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

    //</editor-fold>
}