<?php
/**
 * Created by PhpStorm.
 * User: Loic
 * Date: 01/06/2019
 * Time: 18:57
 */

namespace IWD\JOBINTERVIEW\Manager;


class Manager implements ManagerInterface
{

    const DATABASE_DIR = "data";

    private $db;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        $this->db = array_diff(scandir(self::DATABASE_DIR), array('..', '.'));
    }

    /*public function createCollection(string $entity){
        $objects = [];
        foreach($this->db as $file){
            $json = file_get_contents(self::DATABASE_DIR.'/'.$file);
            $object = json_decode($json);
            $objects[] = ($object->{"$entity"});
        }
        return json_encode(self::aggregateObject($objects));
    }*/

    public function surveys(){
        return json_encode(self::getSurveysType());
    }

    private function getSurveysType(){
        $objects = [];
        foreach($this->db as $file){
            $json = file_get_contents(self::DATABASE_DIR.'/'.$file);
            $object = json_decode($json);
            $objects[] = ($object->survey);
        }
        return self::aggregateObject($objects);
    }

    /*return the data stored in a real db*/
    private function aggregateObject($objects){
        $array = [];
        foreach($objects as $object){
            if(empty($array) || !in_array($object, $array)){
                $array[] = $object;
            }
        }
         return $array;
    }

    public function sortAnswerBySurveys(){
        foreach(self::getSurveysType() as $survey){
            var_dump($survey);
        }
    }

    public function getAllJson(){
        $array = [];
        foreach ($this->db as $file){
            $json = file_get_contents(self::DATABASE_DIR.'/'.$file);
            $object = json_decode($json);
            $array[] = $object;
        }
        return json_encode($array);

    }




}