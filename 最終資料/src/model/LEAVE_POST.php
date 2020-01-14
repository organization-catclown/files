<?php

// 退室処理用POST

if (isset($_POST['l_firstName'])) {
    $rmsc->leaveDataClass->setFirstName($_POST['l_firstName']);
}

if (isset($_POST['l_lastName'])) {
    $rmsc->leaveDataClass->setLastName($_POST['l_lastName']);
}

if (isset($_POST['l_schoolYear'])) {
    $rmsc->leaveDataClass->setSchoolYear($_POST['l_schoolYear']);
}

if (isset($_POST['l_className'])) {
    $rmsc->leaveDataClass->setClassCode($rmsc->classNameArray[$_POST['l_className']]);
}

if (isset($_POST['l_leavingTeacherCode'])) {
    $rmsc->leaveDataClass->setLeavingTeacherCode($_POST['l_leavingTeacherCode']);
}

if (isset($_POST['leave'])) {
    if ($rmsc->cheackLeaveDataClass()) {
        if (DataBaseController::getStudentNumber($rmsc->leaveDataClass->getName(), $rmsc->leaveDataClass->getClassCode(), $rmsc->leaveDataClass->getSchoolYear()) != null) {
            if (DataBaseController::searchTeacherCode($rmsc->leaveDataClass->getLeavingTeacherCode())) {
                if (DataBaseController::searchLeaveData($rmsc->leaveDataClass)) {
                    DataBaseController::leave($rmsc->leaveDataClass);
                    $alert = "<script type='text/javascript'>alert('退室処理が完了しました。');</script>";
                    echo $alert;
                } else {
                    $alert = "<script type='text/javascript'>alert('予約が見つかりません。');</script>";
                    echo $alert;
                }
            } else {
                $alert = "<script type='text/javascript'>alert('教員番号がつかりません。');</script>";
                echo $alert;
            }
        } else {
            $alert = "<script type='text/javascript'>alert('学籍番号が見つかりません。');</script>";
            echo $alert;
        }
    } else {
        $alert = "<script type='text/javascript'>alert('入力漏れがあります。');</script>";
        echo $alert;
    }
}
