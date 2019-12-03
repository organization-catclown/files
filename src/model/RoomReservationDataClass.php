<?php
/*
  教室利用予約用データクラス
*/
class RoomReservationDataClass
{

    private $name;              //生徒の名前（カナ文字フルネーム）
    private $schoolYear;        //学年
    private $classCode;         //学科コード
    private $useRoom;           //利用教室コード
    private $leavingTime;       //退室時間
    private $reasonCode;        //理由コード
    private $entryTeacherCode;  //入室教師印

    public function __construct()
    {
        $this->name = null;
        $this->schoolYear = null;
        $this->classCode = null;
        $this->useRoom = null;
        $this->leavingTime = null;
        $this->reasonCode = null;
        $this->entryTeacherCode = null;
    }

    //==================================
    //        以下アクセサメソッド
    //==================================

    public function setName($nameSei, $nameMei)
    {
        $this->name = $nameSei . " " . $nameMei;
    }

    public function setClassCode($classCode)
    {
        $this->classCode = $classCode;
    }

    public function setSchoolYear($schoolYear)
    {
        $this->schoolYear = $schoolYear;
    }

    public function setUseRoom($useRoom)
    {
        $this->useRoom = $useRoom;
    }

    public function setLeavingTime($leavingHour, $leavingMinute)
    {
        $this->leavingTime = new DateTime('2001-01-01');
        date_time_set($this->leavingTime, $leavingHour, $leavingMinute);
    }

    public function setReasonCode($reasonCode)
    {
        $this->reasonCode = $reasonCode;
    }

    public function setEntryTeacherCode($entryTeacherCode)
    {
        $this->entryTeacherCode = $entryTeacherCode;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getClassCode()
    {
        return $this->classCode;
    }

    public function getSchoolYear()
    {
        return $this->schoolYear;
    }

    public function getUseRoom()
    {
        return $this->useRoom;
    }

    public function getLeavingTime()
    {
        return $this->leavingTime;
    }

    public function getReasonCode()
    {
        return $this->reasonCode;
    }

    public function getEntryTeacherCode()
    {
        return $this->entryTeacherCode;
    }
}
