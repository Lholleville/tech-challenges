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
    /*
     * This method returns the average of all numeric answer
     */
    public static function answerNumeric($array){
        $tmp_array = [];
        foreach($array as $a){
            $tmp_array[] = $a->getAnswer();
        }
        return round(array_sum($tmp_array)/count($tmp_array));
    }

    /*
     * this method returns a list of all date answer
     */
    public static function answerDate($array){
        $tmp_array = [];
        foreach($array as $a){
            $tmp_array[] = $a->getAnswer();
        }
        return $tmp_array;
    }

    /*
     * this method returns the additions of all values in GCM answer.
     */
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