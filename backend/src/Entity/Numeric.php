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
    }

    public static function answer($array){
        $tmp_array = [];
        foreach($array as $a){
            $tmp_array[] = $a->getAnswer();
        }
        return array_sum($tmp_array)/count($tmp_array);
    }
}