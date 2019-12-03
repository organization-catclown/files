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

    public function __construct()
    {
        $this->name = null;
        $this->schoolYear = null;
        $this->classCode = null;
        $this->leavingTeacherCode = null;
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
        $this->leabingTeacherCode = $leavingTeacherCode;
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
