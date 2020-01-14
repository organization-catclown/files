<?php

require 'DataBaseController.php';
require 'LeaveDataClass.php';
require 'RoomReservationDataClass.php';
require 'LogDataClass.php';


/**
 * 教室利用管理システムクラス
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

    // RoomReservationDataClassの初期化
    public function createroomReservationDataClass()
    {
        $this->roomReservationDataClass = new RoomReservationDataClass();
    }

    // LeaveDataClassの初期化
    public function createLeaveDataClass()
    {
        $this->leaveDataClass = new LeaveDataClass();
    }

    // LogDataClassの初期化
    public function createLogDataClass()
    {
        $this->logDataClass = new LogDataClass();
    }

    // 予約処理の際に入力漏れがないかの確認
    public function checkRoomReservationDataClass()
    {
        if (empty($this->roomReservationDataClass->getName())) return false;
        if (empty($this->roomReservationDataClass->getClassCode())) return false;
        if (empty($this->roomReservationDataClass->getSchoolYear())) return false;
        if (empty($this->roomReservationDataClass->getRoomCode())) return false;
        if (empty($this->roomReservationDataClass->getLeavingTime())) return false;
        if (empty($this->roomReservationDataClass->getReasonCode())) return false;
        if (empty($this->roomReservationDataClass->getEntryTeacherCode())) return false;
        return true;
    }

    // 退室処理の際に入力漏れがないか確認
    public function cheackLeaveDataClass()
    {
        if (empty($this->leaveDataClass->getName())) return false;
        if (empty($this->leaveDataClass->getSchoolYear())) return false;
        if (empty($this->leaveDataClass->getClassCode())) return false;
        if (empty($this->leaveDataClass->getLeavingTeacherCode())) return false;
        return true;
    }

    // 学科名を入れるコンボボックスの初期化
    public function setCmbClassName()
    {
        foreach ((array) $this->classNameArray as $key => $value) {
            echo '<option value="' . $key . '">' . $key . '</option>';
        }
    }
    // 教室名を入れるコンボボックスの初期化
    public function setCmbRoomName()
    {
        foreach ((array) $this->roomNameArray as $key => $value) {
            echo '<option value="' . $key . '">' . $key . '</option>';
        }
    }
    // 理由を入れるコンボボックスの初期化
    public function setCmbReasonName()
    {
        foreach ((array) $this->reasonNameArray as $key => $value) {
            echo '<option value="' . $key . '">' . $key . '</option>';
        }
    }

    // 時間を入れるコンボボックスの初期化
    public function setCmbHour()
    {
        for ($i = 0; $i < 24; $i++) {
            echo '<option value="' . $i . '">' . $i . '</option>';
        }
    }

    // 分を入れるコンボボックスの初期化
    public function setCmbMinute()
    {
        for ($i = 0; $i < 60; $i++) {
            echo '<option value="' . $i . '">' . $i . '</option>';
        }
    }

    // ログデータをテーブルタグで表示
    public function showLogData()
    {
        $array = null;
        echo '<table border=1>';
        echo '<tr>';
        echo '<th>学籍番号</th>';
        echo '<th>部屋コード</th>';
        echo '<th>入室印教師番号</th>';
        echo '<th>入室時刻</th>';
        echo '<th>退室印教師番号</th>';
        echo '<th>退室予定時刻</th>';
        echo '<th>理由</th>';
        echo '<th>実退室時刻</th>';
        echo '<th>退室フラグ</th>';
        echo '</tr>';
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
        echo '</table>';
    }
}
