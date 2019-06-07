<?php
/**
 * Created by PhpStorm.
 * User: Loic
 * Date: 02/06/2019
 * Time: 22:13
 */

namespace IWD\JOBINTERVIEW\Entity;


class Numeric extends Answer
{
    public function __construct($object = null)
    {
        parent::__construct($object);
        $this->setType(self::TYPE_NUMERIC);
        $this->setLabel(self::LABEL_NUMERIC);
    }


}