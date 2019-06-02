<?php
/**
 * Created by PhpStorm.
 * User: Loic
 * Date: 02/06/2019
 * Time: 20:32
 */

namespace IWD\JOBINTERVIEW\Entity;


use IWD\JOBINTERVIEW\Manager\ManagerInterface;

abstract class Entity
{

    const DATABASE_DIR = "data";

    private $_data;
    private $_class;
    protected $_db;

    public function construct(){
        $this->_class = self::getClassName();
        $this->_db = array_diff(scandir(self::DATABASE_DIR), array('..', '.'));
    }

    public function all(){
        $objects = [];
        foreach($this->_db as $file){
            $json = file_get_contents(self::DATABASE_DIR.'/'.$file);
            $object = json_decode($json);
            $entity = self::getFullClassName();
            $objects[] = new $entity($object->{"$this->_class"}) ;
        }
        return self::deleteDouble($objects);
    }

    /*Delete double in arrayCollection of Objects*/
    private function deleteDouble($objects){
        $array = [];
        foreach($objects as $object){
            if(empty($array) || !in_array($object, $array)){
                $array[] = $object;
            }
        }
        return $array;
    }

    /*Get class name*/
    private function getClassName(){
        $namespace = explode("\\", get_class($this));
        return lcfirst($namespace[sizeof($namespace) -  1]);
    }

    private function getFullClassName(){
        return get_class($this);
    }


}