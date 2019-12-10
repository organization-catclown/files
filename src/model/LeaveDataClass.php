<?php

/**
 * 
 * 退室用のデータを扱うクラス
 * 
 */
class LeaveDataClass
{

    private $name;          //学生の名前
    private $schoolYear;    //学年
    private $classCode;     //学科コード
    private $leavingTeacherCode;   //教員コード

    private $firstName;
    private $lastName;

    public function __construct()
    {
        $this->name = null;
        $this->schoolYear = null;
        $this->classCode = null;
        $this->leavingTeacherCode = null;

        $firstName = null;
        $lastName = null;
    }

    //==================================
    //        以下アクセサメソッド
    //==================================

    public function setName($name1, $name2)
    {
        $this->name = $name1 . ' ' . $name2;
    }

    public function setSchoolYear($schoolYear)
    {
        $this->schoolYear = $schoolYear;
    }

    public function setClassCode($classCode)
    {
        $this->classCode = $classCode;
    }

    public function setLeavingTeacherCode($leavingTeacherCode)
    {
        $this->leavingTeacherCode = $leavingTeacherCode;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        $this->setName($this->firstName, $this->lastName);
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        $this->setName($this->firstName, $this->lastName);
    }



    public function getName()
    {
        return $this->name;
    }

    public function getSchoolYear()
    {
        return $this->schoolYear;
    }

    public function getClassCode()
    {
        return $this->classCode;
    }

    public function getLeavingTeacherCode()
    {
        return $this->leavingTeacherCode;
    }
}
