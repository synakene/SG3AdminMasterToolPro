<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 01/08/2017
 * Time: 17:44
 */

class Customer extends DBA
{
    private $id;
    private $mail;
    private $admin;
    private $packs;

    private $numSurgeries;
    private $numPatients;
    private $numQuestions;
    private $numMaterials;

    //<editor-fold desc="Getsetter">

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
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    /**
     * @return mixed
     */
    public function getPacks()
    {
        return $this->packs;
    }

    /**
     * @param mixed $packs
     */
    public function setPacks($packs)
    {
        $this->packs = $packs;
    }

    /**
     * @return mixed
     */
    public function getNumSurgeries()
    {
        return $this->numSurgeries;
    }

    /**
     * @param mixed $numSurgeries
     */
    public function setNumSurgeries($numSurgeries)
    {
        $this->numSurgeries = $numSurgeries;
    }

    /**
     * @return mixed
     */
    public function getNumPatients()
    {
        return $this->numPatients;
    }

    /**
     * @param mixed $numPatients
     */
    public function setNumPatients($numPatients)
    {
        $this->numPatients = $numPatients;
    }

    /**
     * @return mixed
     */
    public function getNumQuestions()
    {
        return $this->numQuestions;
    }

    /**
     * @param mixed $numQuestions
     */
    public function setNumQuestions($numQuestions)
    {
        $this->numQuestions = $numQuestions;
    }

    /**
     * @return mixed
     */
    public function getNumMaterials()
    {
        return $this->numMaterials;
    }

    /**
     * @param mixed $numMaterials
     */
    public function setNumMaterials($numMaterials)
    {
        $this->numMaterials = $numMaterials;
    }

    /**
     * @return null
     */
    public static function getisAdmin()
    {
        return self::$isAdmin;
    }

    /**
     * @param null $isAdmin
     */
    public static function setIsAdmin($isAdmin)
    {
        self::$isAdmin = $isAdmin;
    }
    //</editor-fold>

    //<editor-fold desc="Static database fetchers">

    public static function isAdmin($id = 0)
    {
        if (is_array($id))
        {
            return false;
        }

        if ($id == 0)
        {
            $id = $_SESSION['id'];
        }

        $admin = self::query("SELECT `admin` FROM `customer` WHERE `id` = $id")->fetch_array(MYSQLI_ASSOC);
        return $admin['admin'] == 1 ? true : false;
    }

    public static function getById($id = 0)
    {
        $query = self::query("SELECT * FROM `customer` WHERE `id` = $id")->fetch_array(MYSQLI_ASSOC);
        if (count($query) === 0)
        {
            return false;
        }
        $customer = new Customer();

        $customer->setId((int) $query['id']);
        $customer->setMail($query['mail']);
        $customer->setAdmin((int) $query['admin']);

        $packs = self::query("SELECT `idPack` FROM `customerpacks` WHERE `idCustomer` = $id")->fetch_all(MYSQLI_ASSOC);
        $packArray = array();

        foreach ($packs as $pack)
        {
            array_push($packArray, (int) $pack['idPack']);
        }
        $customer->setPacks($packArray);

        $customer->setNumSurgeries(Surgery::getNumRowsByCustomer($id));
        $customer->setNumPatients(Patient::getNumRowsByCustomer($id));
        $customer->setNumQuestions(Question::getNumRowsByCustomer($id));
        $customer->setNumMaterials(Material::getNumRowsByCustomer($id));

        return $customer;
    }

    public static function getAll()
    {
        $query = self::query("SELECT `id` FROM `customer`")->fetch_all(MYSQLI_ASSOC);
        $customers = array();

        foreach ($query as $customerId)
        {
            $customer = Customer::getById($customerId['id']);
            if ($customer !== false)
            {
                array_push($customers, $customer);
            }
        }

        return $customers;
    }

    public static function getCredentialsById($id = 0)
    {
        return self::query("SELECT `mail`, `password` FROM `customer` WHERE `id` = '$id'")->fetch_array(MYSQLI_ASSOC);
    }

    public static function getByMail($mail = '')
    {
        return self::query("SELECT * FROM `customer` WHERE `mail` = '$mail'")->fetch_all(MYSQLI_ASSOC);
    }

    public static function getUserHash($mail = '')
    {
        return self::query("SELECT `password` FROM `customer` WHERE `mail` = '$mail'")->fetch_all(MYSQLI_ASSOC);
    }

    public static function getAvatars($id = 0)
    {
        if (self::isAdmin($id) === true)
        {
            return self::query("SELECT * FROM `avatars`")->fetch_all(MYSQLI_ASSOC);
        }
        else
        {
            return self::query("SELECT * FROM `avatars` WHERE `pack` in ( SELECT `idPack` FROM `customerpacks` WHERE `idCustomer` = $id )")->fetch_all(MYSQLI_ASSOC);
        }
    }

    //</editor-fold>

}