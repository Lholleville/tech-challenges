<?php
/**
 * Created by PhpStorm.
 * User: Loic
 * Date: 01/06/2019
 * Time: 20:28
 */

namespace IWD\JOBINTERVIEW\Entity;


class TypeAnswer
{
    protected $_type;
    protected $_label;

    public function setType(string $type){
        $this->_type = $type;
    }

    public function setLabel(string $label){
        $this->_label = $label;
    }

    public function getType() : string {
        return $this->_type;
    }

    public function getLabel() : string  {
        return $this->_label;
    }
}