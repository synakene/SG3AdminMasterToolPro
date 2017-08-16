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

    public function __construct()
    {

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
        /*if (!is_array($materials))
        {
            $materials = str_replace(' ', '', $materials);
            $materials = explode(',', $materials);
        }

        $this->materials = array();

        foreach ($materials as $material)
        {
            array_push($this->materials, intval($material));
        }*/

        $this->materials = $materials;
    }

    /**
     * @return mixed
     */
    public function getResponses($asString = false)
    {
        if ($asString)
        {
            $str = '';
            foreach ($this->responses as $response)
            {
                $str += $response . ' ';
            }
            return $str;
        }
        else
        {
            return $this->responses;
        }
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
    public function getCompatibles()
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

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'idCustomer' => $this->idCustomer,
            'name' => $this->name,
            'materials' => $this->materials,
            'responses' => $this->responses,
            'compatibles' => $this->compatibles,
            'emergency' => $this->emergency,
            'story' => $this->story,
        ];
    }

    /**
     * Get all surgeries with a defined customer id
     * @param $customerID
     * @return array|bool
     */
    public static function getAllByCustomer($customerID)
    {
        $surgeries = self::query("SELECT * FROM `surgery` WHERE `idCustomer` = $customerID")->fetch_all(MYSQLI_ASSOC);

        if ($surgeries === false)
        {
            return false;
        }

        $surgeries_with_infos = array();

        foreach ($surgeries as $surgery)
        {
            $new_surgery = new Surgery();
            $new_surgery->setId(intval($surgery['id']));
            $new_surgery->setIdCustomer(intval($surgery['idCustomer']));
            $new_surgery->setName($surgery['name']);
            $new_surgery->setEmergency($surgery['emergency'] === '1' ? true : false);
            $new_surgery->setStory($surgery['story']);

            $materials = self::query("SELECT `idMaterial` FROM `material_liaison` WHERE `spawnedBy` = 0 && `idSpawner` = $new_surgery->id")->fetch_all(MYSQLI_ASSOC);
            $mat_array = array();
            foreach ($materials as $material)
            {
                array_push($mat_array, (int) $material['idMaterial']);
            }
            $new_surgery->setMaterials($mat_array);

            $questions = self::query("SELECT `idQuestion` FROM `questions_liaison` WHERE `spawnedBy` = 0 && `idSpawner` = $new_surgery->id")->fetch_all(MYSQLI_ASSOC);
            $questions_array = array();
            foreach ($questions as $question)
            {
                array_push($questions_array, (int) $question['idQuestion']);
            }
            $new_surgery->setResponses($questions_array);

            $patients = self::query("SELECT `idPatient` FROM `patient_liaison` WHERE `idSurgery` = 1")->fetch_all(MYSQLI_ASSOC);
            $patients_array = array();
            foreach ($patients as $patient)
            {
                array_push($patients_array, (int) $patient['idPatient']);
            }
            $new_surgery->setCompatibles($patients_array);

            array_push($surgeries_with_infos, $new_surgery);
        }

        return $surgeries_with_infos;
    }
}