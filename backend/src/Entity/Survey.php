<?php
/**
 * Created by PhpStorm.
 * User: Loic
 * Date: 01/06/2019
 * Time: 19:40
 */

namespace IWD\JOBINTERVIEW\Entity;


class Survey extends Entity
{
    private $_name;
    private $_code;

    private $answers = [];
    private $_numericAnswers = [];
    private $_qcmAnswers = [];
    private $_dateAnswers = [];

    public function __construct($object = null)
    {
        parent::construct();
        if($object != null){
            if(isset($object->name)){
                self::setName($object->name);
            }
            if(isset($object->code)){
                self::setCode($object->code);
            }
        }
    }

    public function getAnswers(){
        foreach($this->_db as $file)
        {
            $json = file_get_contents(self::DATABASE_DIR.'/'.$file);
            $object = json_decode($json);
            if($object->survey->name == $this->getName()){
                foreach ($object->questions as $q){
                    $class = "IWD\JOBINTERVIEW\Entity\\".ucfirst($q->type);
                    $this->answers[] = new $class($q);
                }
            }
        }
        return $this->answers;
    }

    public function getDetailedAnswers(){
        self::SepareAnswers();
        echo '<pre>';
        $numeric_value = Numeric::answer($this->_numericAnswers);
        var_dump($numeric_value);
        $date_value = Date::answer($this->_dateAnswers);
        var_dump($date_value);
        $scm_value = Qcm::answer($this->_qcmAnswers);
        var_dump($scm_value);

    }


    private function SepareAnswers(){
        $answers = self::getAnswers();
        foreach($answers as $answer){
            switch($answer->getType()){
                case "numeric" :
                    $this->_numericAnswers[] = $answer;
                    break;
                case "qcm" :
                    $this->_qcmAnswers[] = $answer;
                    break;
                case "date" :
                    $this->_dateAnswers[] = $answer;
            }
        }
    }

    public function getName() : string {
        return $this->_name;
    }

    public function getCode() : string {
        return $this->_code;
    }

    public function setName(string $string) {
        $this->_name = $string;
    }

    public function setCode(string $code){
        $this->_code = $code;
    }

    private function getAverageNumericAnswer(){

    }

}