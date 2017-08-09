<?php
/**
 * User: Romain Foucher
 * Date: 01/08/2017
 * Time: 17:45
 */

class Material extends DBA
{
    private $id;
    private $idCustomer;
    private $name;
    private $category;

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

    //</editor-fold>


    //<editor-fold desc="Database writers">

    /**
     * Check validy for database writing.
     * Always use this function before writing !
     * @return bool
     */
    public function checkValidity()
    {
        if ($this->id === 0 || $this->idCustomer === 0|| $this->name === '' || $this->category === '')
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
        $query = self::query("SELECT * FROM `material` WHERE `id` = $this->id");
        if ($query === false || $query->num_rows == 0)
        {
            return self::query("INSERT INTO `material` (`id`, `idCustomer`, `name`, `category`) VALUES (NULL, $this->idCustomer, '$this->name', '$this->category');");
        }

        if (!$this->checkValidity())
        {
            return false;
        }

        $result = self::query("UPDATE `material` SET `idCustomer` = $this->idCustomer, `name` = '$this->name', `category` = '$this->category' WHERE `material`.`id` = $this->id;");
        return $result;
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
    public static function getAllByCustomer($id = 0)
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
                array_push($materials, $new_material);
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
        return self::query('SELECT `category` FROM `material` WHERE `idCustomer` = ' . $idCustomer)->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get next id used by id sequence
     * @return int
     */
    public static function getNextId()
    {
        return intval(self::query('SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = \'material\'')->fetch_all(MYSQLI_ASSOC)[0]['auto_increment']);
    }

    //</editor-fold>

}