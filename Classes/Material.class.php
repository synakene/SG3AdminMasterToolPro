<?php
/**
 * User: Romain Foucher
 * Date: 01/08/2017
 * Time: 17:45
 */

class Material extends DBA
{
    private $id;
    private $name;
    private $category;

    public function __construct($id = 0, $name = '', $category = '')
    {
        if ($id == 0 || $name == '' || $category == '')
        {
            return;
        }

        $this->id = $id;
        $this->name = $name;
        $this->category= $category;
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
            $new_material = new Material(intval($line['id']), $line['name'], $line['category']);
            array_push($materials, $new_material);
        }

        return $materials;
    }

    public static function getCategoriesByCustomer($id = 0)
    {
        return self::query('SELECT DISTINCT category FROM `material` WHERE `idCustomer` = ' . $id)->fetch_all(MYSQLI_ASSOC);
    }
}