<?php

require 'DataBaseController.php';
require 'LeaveDataClass.php';
require 'RoomReservationDataClass.php';
require 'LogDataClass.php';


/**
 * 教室利用管理システムに関するデータをまとめる用のクラス
 */
class RMSController
{
    public $leaveDataClass;
    public $roomReservationDataClass;
    public $logDataClass;
    public $classNameArray;
    public $roomNameArray;
    public $reasonNameArray;
    public $permissionRoomArray;

    /**
     * コンボボックスに入れる教室名、学科名、理由の連想配列を取得
     */
    public function fetchSelectDatas()
    {
        $this->roomNameArray = DataBaseController::fetchRoomData();
        $this->classNameArray = DataBaseController::fetchClassData();
        $this->reasonNameArray = DataBaseController::fetchReasonData();
    }

    /**
     * リフレッシュ用
     * 変数にnullを代入しfetchSelectDatas関数を呼び出す
     */
    public function refreshData()
    {
        $this->leaveDataClass = null;
        $this->roomReservationDataClass = null;
        $this->logDataClass = null;
        $this->roomNameArray = null;
        $this->classNameArray = null;
        $this->reasonNameArray = null;

        gc_collect_cycles();

        $this->fetchSelectDatas();
    }

    public function createroomReservationDataClass()
    {
        $this->roomReservationDataClass = new RoomReservationDataClass();
    }

    public function createLeaveDataClass()
    {
        $this->leaveDataClass = new LeaveDataClass();
    }

    public function createLogDataClass()
    {
        $this->logDataClass = new LogDataClass();
    }

    public function checkRoomReservationDataClass()
    {
        if (empty($this->roomReservationDataClass->getName())) return false;
        if (empty($this->roomReservationDataClass->getClassCode())) return false;
        if (empty($this->roomReservationDataClass->getSchoolYear())) return false;
        if (empty($this->roomReservationDataClass->getRoomCode())) return false;
        if (empty($this->roomReservationDataClass->getLeavingTime())) return false;
        if (empty($this->roomReservationDataClass->getReasonCode())) return false;
        return true;
    }

    public function cheackLeaveDataClass()
    {
        if (empty($this->leaveDataClass->getName())) return false;
        if (empty($this->leaveDataClass->getSchoolYear())) return false;
        if (empty($this->leaveDataClass->getClassCode())) return false;
        if (empty($this->leaveDataClass->getLeavingTeacherCode())) return false;
        return true;
    }

    public  function fetchPermissionRoom($className)
    {
        $this->permissionRoomArray = $this->dbc->fetchClassCode($className);
        return $this->permissionRoomArray;
    }

    // 学科名を入れるコンボボックスの初期化
    public function setCmbClassName()
    {
        foreach ((array) $this->classNameArray as $key => $value) {
            echo '<option value="">' . $key . '</option>';
        }
    }
    // 教室名を入れるコンボボックスの初期化
    public function setCmbRoomName()
    {
        foreach ((array) $this->roomNameArray as $key => $value) {
            echo '<option value="">' . $key . '</option>';
        }
    }
    // 理由を入れるコンボボックスの初期化
    public function setCmbReasonName()
    {
        foreach ((array) $this->reasonNameArray as $key => $value) {
            echo '<option value="">' . $key . '</option>';
        }
    }

    public function showLogData()
    {
        $array = null;
        if (($array = DataBaseController::fetchLogData()) != null) {
            foreach ((array) $array as $buff) {
                echo '<tr>';
                echo '<td>' . $buff->getStudentNumber() . '</td>';
                echo '<td>' . $buff->getRoomCode() . '</td>';
                echo '<td>' . $buff->getEntryTeacherCode() . '</td>';
                echo '<td>' . $buff->getEntryTime() . '</td>';
                echo '<td>' . $buff->getLeavingTeacherCode() . '</td>';
                echo '<td>' . $buff->getLeavingTime() . '</td>';
                echo '<td>' . $buff->getReasonCode() . '</td>';
                echo '<td>' . $buff->getEndDate() . '</td>';
                echo '<td>' . $buff->getEndFlag() . '</td>';
                echo '</tr>';
            }
        }
    }
}
