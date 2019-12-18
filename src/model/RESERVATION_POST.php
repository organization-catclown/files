<?php

// 予約処理用GET

if (isset($_GET['r_lastName'])) {
    $rmsc->roomReservationDataClass->setLastName($_GET['r_lastName']);
}

if (isset($_GET['r_firstName'])) {
    $rmsc->roomReservationDataClass->setFirstName($_GET['r_firstName']);
}

if (isset($_GET['r_schoolYear'])) {
    $rmsc->roomReservationDataClass->setSchoolYear($_GET['r_schoolYear']);
}

if (isset($_GET['r_className'])) {
    $rmsc->roomReservationDataClass->setClassCode($rmsc->classNameArray[$_GET['r_className']]);
}

if (isset($_GET['r_roomName'])) {
    $rmsc->roomReservationDataClass->setRoomCode($rmsc->roomNameArray[$_GET['r_roomName']]);
}

if (isset($_GET['r_leavingTimeHour'])) {
    $rmsc->roomReservationDataClass->setLeavingHour($_GET['r_leavingTimeHour']);
}

if (isset($_GET['r_leavingTimeMinute'])) {
    $rmsc->roomReservationDataClass->setLeavingMinute($_GET['r_leavingTimeMinute']);
}

if (isset($_GET['r_reason'])) {
    $rmsc->roomReservationDataClass->setReasonCode($rmsc->reasonNameArray[$_GET['r_reason']]);
}

if (isset($_GET['r_entryTeacherCode'])) {
    $rmsc->roomReservationDataClass->setEntryTeacherCode($_GET['r_entryTeacherCode']);
}

if (isset($_GET['insert'])) {
    if ($rmsc->checkRoomReservationDataClass()) {
        if (DataBaseController::getStudentNumber($rmsc->roomReservationDataClass->getName(), $rmsc->roomReservationDataClass->getClassCode(), $rmsc->roomReservationDataClass->getSchoolYear()) != null) {
            if (DataBaseController::searchTeacherCode($rmsc->roomReservationDataClass->getEntryTeacherCode())) {
                if (!DataBaseController::doubleCheck($rmsc->roomReservationDataClass)) {
                    DataBaseController::reservation($rmsc->roomReservationDataClass);
                    $alert = "<script type='text/javascript'>alert('予約処理が完了しました。');</script>";
                    echo $alert;
                } else {
                    $alert = "<script type='text/javascript'>alert('既に教室を予約しています。');</script>";
                    echo $alert;
                }
            } else {
                $alert = "<script type='text/javascript'>alert('教員番号がつかりません。');</script>";
                echo $alert;
            }
        } else {
            $alert = "<script type='text/javascript'>alert('学籍番号が見つかりませんでした。');</script>";
            echo $alert;
        }
    } else {
        $alert = "<script type='text/javascript'>alert('入力漏れがあります。');</script>";
        echo $alert;
    }
}
