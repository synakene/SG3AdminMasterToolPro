<?php
/**
 * Created by PhpStorm.
 * User: Lebreton
 * Date: 01/08/2017
 * Time: 17:45
 */

class Question extends DBA
{
    private $id;
    private $idCustomer;
    private $name;
    private $answer;

    public function __construct($id = 0, $idCustomer = 0, $name = '', $answer = '')
    {
        $this->id = $id;
        $this->idCustomer = $idCustomer;
        $this->name = $name;
        $this->answer = $answer;
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
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param mixed $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
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
        if ($checkId === true && $this->id === 0)
        {
            return false;
        }

        if ($this->idCustomer === 0|| $this->name === '' || $this->answer === '')
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
        $query = self::query("SELECT * FROM `questions` WHERE `id` = $this->id");

        $name = str_replace("'", "\'", $this->name);
        $answer = str_replace("'", "\'", $this->answer);

        if ($query->num_rows === 0 && $this->checkValidity(false))
        {
            return self::query("INSERT INTO `questions` (`id`, `idCustomer`, `name`, `answer`) VALUES (NULL, $this->idCustomer, '$name', '$answer');");
        }
        else if ($query->num_rows === 1 && $this->checkValidity())
        {
            return self::query("UPDATE `questions` SET `idCustomer` = $this->idCustomer, `name` = '$name', `answer` = '$answer' WHERE `questions`.`id` = $this->id;");
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
        return self::query("DELETE FROM `questions` WHERE `questions`.`id` = $this->id");
    }

    //</editor-fold>


    //<editor-fold desc="Fetchers">

    /**
     * Return a question by id
     * @param int $id
     * @return mixed
     */
    public static function getById($id = 0)
    {
        $question = self::query("SELECT * FROM `questions` WHERE `id` = $id")->fetch_array(MYSQLI_ASSOC);

        if (is_null($question))
        {
            return false;
        }

        return new Question($question['id'], $question['idCustomer'], $question['name'], $question['answer']);
    }

    /**
     * Get all questions by customer id
     * @param int $idCustomer
     * @return mixed
     */
    public static function getAllByCustomer($idCustomer = 0)
    {
        $query = self::query("SELECT * FROM `questions` WHERE `idCustomer` = $idCustomer")->fetch_all(MYSQLI_ASSOC);
        $questions = array();

        foreach ($query as $question)
        {
            array_push($questions, new Question($question['id'], $question['idCustomer'], $question['name'], $question['answer']));
        }

        return $questions;
    }

    /**
     * Get next id used by id sequence
     * @return int
     */
    public static function getNextId()
    {
        return intval(self::query('SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = \'questions\'')->fetch_all(MYSQLI_ASSOC)[0]['auto_increment']);
    }

    //</editor-fold>
}