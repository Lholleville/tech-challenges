<?php

use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: LoïcHOLLEVILLE
 * Date: 07/06/2019
 * Time: 16:03
 */

class ResolverTest extends TestCase
{
    private $testArrayNumeric;
    private $testArrayDate;
    private $testArrayQcm;

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->setTestArrayDate();
        $this->setTestArrayNumber();
        $this->setTestArrayQcm();
    }

    /*GETTERS AND SETTERS */
    public function getTestArrayNumeric(){
        return $this->testArrayNumeric;
    }

    public function setTestArrayNumber(){
        for($i = 0; $i < 10; $i++){
            $numeric = new \IWD\JOBINTERVIEW\Entity\Numeric();
            $numeric->setAnswer(10 * $i);
            $this->testArrayNumeric[] = $numeric;
        }
    }

    public function getTestArrayDate(){
        return $this->testArrayDate;
    }

    public function setTestArrayDate(){
        for($i = 0; $i < 10; $i++){
            $date = new \IWD\JOBINTERVIEW\Entity\Numeric();
            $date->setAnswer(date(DateTimeInterface::ISO8601));
            $this->testArrayDate[] = $date;
        }
    }
    public function getTestArrayQcm(){
        return $this->testArrayQcm;
    }

    public function setTestArrayQcm(){
        for($i = 0; $i < 10; $i++){
            $qcm = new \IWD\JOBINTERVIEW\Entity\Qcm();

            $possible_values = [true, false];

            $array = array(
                "_options" => ["product 1","product 2","product 3","product 4","product 5","product 6"],
                "_answer" => [$possible_values[rand(0,1)], $possible_values[rand(0,1)], $possible_values[rand(0,1)], $possible_values[rand(0,1)], $possible_values[rand(0,1)], $possible_values[rand(0,1)]]
            );

            $qcm->setAnswer($array["_answer"]);
            $qcm->setOptions($array["_options"]);

            $this->testArrayQcm[] = $qcm;
        }
    }

    /*TESTS*/

    /*test numeric answer result type*/

    public function testNumericAnswerIsDigit(){
        $this->assertInternalType("float", \IWD\JOBINTERVIEW\Classes\Resolver::answerNumeric($this->getTestArrayNumeric()));
    }

    /*test if numeric answer result is the average*/
    public function testNumericAnswerResult(){

        $this->assertEquals(45,  \IWD\JOBINTERVIEW\Classes\Resolver::answerNumeric($this->getTestArrayNumeric()));
    }

    /*test data answer result type*/
    public function testDateAnswerIsArray(){
        //test if answer is array
        $this->assertInternalType("array", \IWD\JOBINTERVIEW\Classes\Resolver::answerDate($this->getTestArrayDate()));
        //test if number of items matches
        $this->assertEquals(10, count($this->getTestArrayDate()));
        //test if every answer is a valid date.
        for($i = 0; $i < count($this->getTestArrayDate()); $i++){
            $this->assertTrue((bool)strtotime($this->getTestArrayDate()[$i]->getAnswer()));
        }
    }

    public function testQcmAnswerResult(){
        //check if answer is array
        $this->assertInternalType("array", \IWD\JOBINTERVIEW\Classes\Resolver::answerQcm($this->getTestArrayQcm()));
        //test if there are the same number of answers and the same number of options
        foreach($this->getTestArrayQcm() as $qcmAnswer){
            $this->assertEquals(count($qcmAnswer->getOptions()), count($qcmAnswer->getAnswer()));
        }
        //test if the result array of QCM answer has required keys
        $result = \IWD\JOBINTERVIEW\Classes\Resolver::answerQCM($this->getTestArrayQcm());

        for($i = 1; $i < 7; $i++){
            $this->assertArrayHasKey("product ".$i, \IWD\JOBINTERVIEW\Classes\Resolver::answerQCM($this->getTestArrayQcm()));
            self::assertThat($result["product ".$i] >= 0, self::isTrue());
        }
    }
}