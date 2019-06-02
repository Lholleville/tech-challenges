<?php
/**
 * Created by PhpStorm.
 * User: Loic
 * Date: 01/06/2019
 * Time: 20:21
 */

namespace IWD\JOBINTERVIEW\Factory;


use IWD\JOBINTERVIEW\Manager\Manager;
use IWD\JOBINTERVIEW\Entity\Survey;

class SurveyFactory
{
    public function createSurvey() {
        $db = new Manager();
        $data = json_decode($db->getAllJson());

        foreach($data as $object){
            $survey = new Survey($object);
            echo '<pre>';
            var_dump($survey);
            echo '</pre>';
        }
    }
}