<?php
/**
 * Created by PhpStorm.
 * User: Loic
 * Date: 02/06/2019
 * Time: 23:05
 */

namespace IWD\JOBINTERVIEW\Classes;


use IWD\JOBINTERVIEW\Entity\Qcm;

class Resolver
{
    public static function answerGCM($array){

    }

    public static function answerNumeric($array){
        $tmp_array = [];
        foreach($array as $a){
            $tmp_array[] = $a->getAnswer();
        }
        return array_sum($tmp_array)/count($tmp_array);
    }

    public static function answerDate($array){
        $tmp_array = [];
        foreach($array as $a){
            $tmp_array[] = $a->getAnswer();
        }
        return $tmp_array;
    }

    public static function answerQCM($array)
    {
        $tmp_array = [];
        foreach ($array as $qcm){
            $tmp_array[] = $qcm->getMixedAnswerWithOptions();
        }

        $sumArray = array();

        foreach ($tmp_array as $k=>$subArray) {
            foreach ($subArray as $id=>$value) {
                array_key_exists( $id, $sumArray ) ? $sumArray[$id] += $value : $sumArray[$id] = $value;
            }
        }
        return $sumArray;
    }
}