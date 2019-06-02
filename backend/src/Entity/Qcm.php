<?php
/**
 * Created by PhpStorm.
 * User: Loic
 * Date: 02/06/2019
 * Time: 22:12
 */

namespace IWD\JOBINTERVIEW\Entity;


class Qcm extends Answer
{

    public function __construct($object = null)
    {
        parent::__construct($object);
        if(isset($object->options)){
            self::setOptions($object->options);
        }
    }

    public function getOptions(){
        return $this->_options;
    }
    public function setOptions($array = null){
        $this->_options = $array;
    }

    public static function answer(){
        
    }

    private function getResult()
    {
        $i = 0;
        $tmp_array = [];
        foreach($this->getOptions() as $option){
            $tmp_array[] = array($option => ($this->getAnswer()[$i]) ? 1 : 0);
        }
        return array_merge($tmp_array);

    }
}