<?php
/**
 * Created by PhpStorm.
 * User: Loic
 * Date: 01/06/2019
 * Time: 20:39
 */

namespace IWD\JOBINTERVIEW\Factory;


class AnswerFactory
{
    public function createAnswer(){
        $data = new \IWD\JOBINTERVIEW\Manager\Manager();
        var_dump($data->createCollection("questions"));
    }
}