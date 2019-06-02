<?php
/**
 * Created by PhpStorm.
 * User: Loic
 * Date: 01/06/2019
 * Time: 19:40
 */

namespace IWD\JOBINTERVIEW\Entity;


use IWD\JOBINTERVIEW\Classes\Resolver;

class Survey extends Entity
{
    private $_name;
    private $_code;

    private $answers = [];
    private $_numericAnswers = [];
    private $_qcmAnswers = [];
    private $_dateAnswers = [];

    private $_numericResult;
    private $_qcmResult;
    private $_dateResult;


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
        $this->_numericResult = Resolver::answerNumeric($this->_numericAnswers);
        $this->_dateResult = Resolver::answerDate($this->_dateAnswers);
        $this->_qcmResult = Resolver::answerQCM($this->_qcmAnswers);
    }

    public function render(){
        $render["survey"][] = ["name" => $this->getName(), "code" => $this->getCode()];
        $render["answers"][] = ["type" => $this->_qcmAnswers[0]->getType(), "label" => $this->_qcmAnswers[0]->getLabel(), "answer" => $this->_qcmResult];
        $render["answers"][] = ["type" => $this->_numericAnswers[0]->getType(), "label" => $this->_numericAnswers[0]->getLabel(), "answer" => $this->_numericResult];
        $render["answers"][] = ["type" => $this->_dateAnswers[0]->getType(), "label" => $this->_dateAnswers[0]->getLabel(), "answer" => $this->_dateResult];
        return $render;
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



}