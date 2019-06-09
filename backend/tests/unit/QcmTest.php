<?php

use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: Loic
 * Date: 09/06/2019
 * Time: 21:51
 */

class QcmTest extends TestCase
{
    public function testGetMixedAnswerWithOptions(){
        $qcm = new \IWD\JOBINTERVIEW\Entity\Qcm();

        $possible_values = [true, false];

        $array = array(
            "_options" => ["product 1","product 2","product 3","product 4","product 5","product 6"],
            "_answer" => [$possible_values[rand(0,1)], $possible_values[rand(0,1)], $possible_values[rand(0,1)], $possible_values[rand(0,1)], $possible_values[rand(0,1)], $possible_values[rand(0,1)]]
        );

        $qcm->setAnswer($array["_answer"]);
        $qcm->setOptions($array["_options"]);

        foreach($qcm->getMixedAnswerWithOptions() as $answer){
            $this->assertInternalType("integer", $answer);
        }
    }
}