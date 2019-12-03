<?php

class LogDataClass
{
    private $studentNumber;         //学籍番号
    private $roomCode;              //教室コード
    private $entryTeacherCode;      //入室予約時教員番号
    private $entryTime;             //入室開始時刻
    private $leavingTeacherCode;    //退室時教員番号
    private $leavingTime;           //退室予定時刻
    private $reasonCode;            //理由コード
    private $endDate;               //実退室時刻
    private $endFlag;               //退室フラグ true:退室済 false:未退室


    /*
    public function __construct($studentNumber, $roomCode, $entryTeacherCode, $entryTime, $leavingTeacherCode, $leavingTime, $reasonCode, $endDate, $endFlag)
    {
        $this->studentNumber = $studentNumber;
        $this->roomCode = $roomCode;
        $this->entryTeacherCode = $entryTeacherCode;
        $this->entryTime = $entryTime;
        $this->leavingTeacherCode = $leavingTeacherCode;
        $this->leavingTime = $leavingTime;
        $this->reasonCode = $reasonCode;
        $this->endDate = $endDate;
        $this->endFlag = $endFlag;
    }
*/

    //==================================
    //        以下アクセサメソッド
    //==================================

    public function setStudentNumber($studentNumber)
    {
        $this->studentNumber = $studentNumber;
    }

    public function setRoomCode($roomCode)
    {
        $this->roomCode = $roomCode;
    }

    public function setEntryTeacherCode($entryTeacherCode)
    {
        $this->entryTeacherCode = $entryTeacherCode;
    }

    public function setEntryTime($entryTime)
    {
        $this->entryTime = $entryTime;
    }

    public function setLeavingTeacherCode($leavingTeacherCode)
    {
        $this->leavingTeacherCode = $leavingTeacherCode;
    }

    public function setLeavingTime($leavingTime)
    {
        $this->leavingTime = $leavingTime;
    }

    public function setReasonCode($reasonCode)
    {
        $this->reasonCode = $reasonCode;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    public function setEndFlag($endFlag)
    {
        $this->endFlag = $endFlag;
    }

    public function getStudentNumber()
    {
        return $this->studentNumber;
    }

    public function getRoomCode()
    {
        return $this->roomCode;
    }

    public function getEntryTeacherCode()
    {
        return $this->entryTeacherCode;
    }

    public function getEntryTime()
    {
        return $this->entryTime;
    }

    public function getLeavingTeacherCode()
    {
        return $this->leavingTeacherCode;
    }

    public function getLeavingTime()
    {
        return $this->leavingTime;
    }

    public function getReasonCode()
    {
        return $this->reasonCode;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function getEndFlag()
    {
        return $this->endFlag;
    }
}
