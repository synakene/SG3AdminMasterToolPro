<?php
/**
 * User: Romain Foucher
 * Date: 01/08/2017
 * Time: 17:45
 */

class Material extends DBA implements JsonSerializable
{
    private $id;
    private $idCustomer;
    private $name;
    private $category;

    public $jsonCustomer = false;

    public function __construct($id = 0, $idCustomer = 0, $name = '', $category = '')
    {
        if ($id === 0 || $idCustomer === 0|| $name === '' || $category === '')
        {
            return;
        }

        $this->id = $id;
        $this->idCustomer = $idCustomer;
        $this->name = $name;
        $this->category = $category;
    }

    //<editor-fold desc="Getters and Setters">

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getIdCustomer()
    {
        return $this->idCustomer;
    }

    /**
     * @param int $idCustomer
     */
    public function setIdCustomer($idCustomer)
    {
        $idCustomer = intval($idCustomer);
        if ($idCustomer < 0)
            $idCustomer = 0;

        $this->idCustomer = $idCustomer;
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
    public function jsonSerialize()
    {
        $json = [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
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
    public function checkValidity()
    {
        if ($this->idCustomer === 0|| $this->name === '' || $this->category === '')
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
        if (!$this->checkValidity())
        {
            return false;
        }

        if ($this->id === null)
            $this->id = 0;

        $query = self::query("SELECT * FROM `material` WHERE `id` = $this->id");

        if ($query === false || $query->num_rows == 0)
        {
            return self::query("INSERT INTO `material` (`id`, `idCustomer`, `name`, `category`) VALUES (NULL, $this->idCustomer, '$this->name', '$this->category');");
        }

        $result = self::query("UPDATE `material` SET `idCustomer` = $this->idCustomer, `name` = '$this->name', `category` = '$this->category' WHERE `material`.`id` = $this->id;");
        return $result;
    }

    /**
     * Destroy
     * @return mixed
     */
    public function destroy()
    {
        self::startTransaction();
        $id = $this->id;
        $win = self::query("DELETE FROM material_liaison WHERE idMaterial = $id;");
        $win = self::query("DELETE FROM `material` WHERE `material`.`id` = $this->id") && $win;

        if ($win)
            self::finishTransaction();
        else
            self::cancelTransaction();

        return $win;
    }

    //</editor-fold>


    //<editor-fold desc="Static database fetchers">

    /**
     * Fetch a materiel from its id
     * @param $id
     * @return bool|Material
     */
    public static function getById($id)
    {
        $result = self::query("SELECT * FROM `material` WHERE `id` = $id")->fetch_all(MYSQLI_ASSOC);

        if (sizeof($result) === 0)
        {
            return false;
        }

        $material = new Material(intval($result[0]['id']), intval(($result[0]['idCustomer'])), $result[0]['name'], $result[0]['category']);

        if ($material->getId() !== null)
        {
            return $material;
        }

        return false;
    }


    /**
     * Get a list of material by client id.
     * Return false if no material found
     * @param int $id
     * @return array|bool
     */
    public static function getAllByCustomer($id = 0, $idIndexes = false)
    {
        $result = self::query('SELECT * FROM `material` WHERE `idCustomer` = ' . $id)->fetch_all(MYSQLI_ASSOC);

        if ($result === false)
        {
            return false;
        }

        $materials = array();

        foreach ($result as $line)
        {
            $new_material = new Material(intval($line['id']), intval(($line['idCustomer'])), $line['name'], $line['category']);
            if ($new_material->getId() !== null)
            {
                $idIndexes === true ? $materials[$new_material->getId()] = $new_material : array_push($materials, $new_material);
            }
        }

        return $materials;
    }


    /**
     * Return all distincts categories for a client
     * @param int $idCustomer
     * @return mixed
     */
    public static function getCategoriesByCustomer($idCustomer = 0)
    {
        return self::query('SELECT DISTINCT `category` FROM `material` WHERE `idCustomer` = ' . $idCustomer)->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get next id used by id sequence
     * @return int
     */
    public static function getNextId()
    {
        return intval(self::query('SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = \'material\'')->fetch_all(MYSQLI_ASSOC)[0]['auto_increment']);
    }

    /**
     * Get number of materials set by a customer
     * @param int $idCustomer
     * @return int
     */
    public static function getNumRowsByCustomer($idCustomer = 0)
    {
        return intval(self::query("SELECT COUNT(`id`) FROM `material` WHERE `idCustomer` = $idCustomer")->fetch_array()[0]);
    }

    //</editor-fold>
}