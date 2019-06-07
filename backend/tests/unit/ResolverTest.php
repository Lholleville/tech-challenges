<?php
/**
 * Created by PhpStorm.
 * User: LoïcHOLLEVILLE
 * Date: 07/06/2019
 * Time: 16:03
 */

class ResolverTest extends \PHPUnit\Framework\TestCase
{

    private $testArrayNumeric;
    private $testArrayDate;
    private $testArrayQcm;

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->setTestArrayDate();
        $this->setTestArrayNumber();


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
            $qcm->setAnswer(date(DateTimeInterface::ISO8601));
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
        $this->assertInternalType("array", \IWD\JOBINTERVIEW\Classes\Resolver::answerDate($this->getTestArrayDate()));
    }
}