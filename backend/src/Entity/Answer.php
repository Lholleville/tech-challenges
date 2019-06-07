<?php
/**
 * Created by PhpStorm.
 * User: Loic
 * Date: 01/06/2019
 * Time: 20:18
 */

namespace IWD\JOBINTERVIEW\Entity;


abstract class Answer
{

    const TYPE_NUMERIC = "numeric";
    const TYPE_QCM = "qcm";
    const TYPE_DATE = "date";

    const LABEL_NUMERIC = "Number of products?";
    const LABEL_QCM = "What best sellers are available in your store?";
    const LABEL_DATE = "What is the visit date?";

    private $_type;
    private $_label;
    private $_answer;

    public function __construct($object = null)
    {

        if($object != null && is_object($object)){

            if(isset($object->answer)){
                self::setAnswer($object->answer);
            }
        }
    }

    public function getType(){
        return $this->_type;
    }

    public function getLabel(){
        return $this->_label;
    }


    public function getAnswer(){
        return $this->_answer;
    }

    public  function setType(string $type){
        $this->_type = $type;
    }

    public function setLabel(string $label){
        $this->_label = $label;
    }



    public function setAnswer($mixvalues){
        $this->_answer = $mixvalues;
    }

}