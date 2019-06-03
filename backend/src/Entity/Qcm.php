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

    private $_options;

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

    /*
     * this method convert boolean into int values
     * */
    public function getMixedAnswerWithOptions()
    {
        $tmp = array();
        $i = 0;
        foreach($this->getOptions() as $option)
        {
            $tmp[$option] = ($this->getAnswer()[$i]) ? 1 : 0;
            $i++;
        }
        return $tmp;
    }
}