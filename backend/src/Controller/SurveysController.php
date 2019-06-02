<?php
/**
 * Created by PhpStorm.
 * User: Loic
 * Date: 02/06/2019
 * Time: 20:28
 */

namespace IWD\JOBINTERVIEW\Controller;


use IWD\JOBINTERVIEW\Entity\Survey;
use Symfony\Component\Routing\Annotation\Route;

class SurveysController
{
    /**
     * route : localhost:8080/surveys
     * @return string
     */
    public function surveyList(){
        $surveys = new Survey();
        $results = [];
        foreach($surveys->all() as $survey){
            $results[] = [$survey->getName(), $survey->getCode()];
        }
        return json_encode($results);
    }

    /**
     * route : localhost:8080/surveys-aggregate
     * @return string
     */
    public function surveyGetAnswers(){
        $surveys = new Survey();

        foreach($surveys->all() as $survey){
            $survey->getDetailedAnswers();
            $json[] = $survey->render();
        }

        return json_encode($json);
    }
}