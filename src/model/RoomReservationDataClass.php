<?php
/*
  教室利用予約用データクラス
*/
class RoomReservationDataClass
{

    private $name;              //生徒の名前（カナ文字フルネーム）
    private $schoolYear;        //学年
    private $classCode;         //学科コード
    private $roomCode;          //利用教室コード
    private $leavingTime;       //退室時間
    private $reasonCode;        //理由コード
    private $entryTeacherCode;  //入室教師印

    private $firstName;
    private $lastName;
    private $leavingHour;
    private $leavingMinute;

    public function __construct()
    {
        $this->name = null;
        $this->schoolYear = null;
        $this->classCode = null;
        $this->roomCode = null;
        $this->leavingTime = new DateTime('2001-01-01');
        $this->reasonCode = null;
        $this->entryTeacherCode = null;

        $firstName = null;
        $lastName = null;
        $leavingHour = 1;
        $leavingMinute = 1;
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

    public function setRoomCode($roomCode)
    {
        $this->roomCode = $roomCode;
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

    public function setLeavingHour($leavingHour)
    {
        $this->leavingHour = $leavingHour;
        $this->setLeavingTime($this->leavingHour, $this->leavingMinute);
    }

    public function setLeavingMinute($leavingMinute)
    {

        $this->leavingMinute = $leavingMinute;
        $this->setLeavingTime($this->leavingHour, $this->leavingMinute);
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

    public function getRoomCode()
    {
        return $this->roomCode;
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
