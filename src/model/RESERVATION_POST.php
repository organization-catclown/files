<?php

// 予約処理用POST

if (isset($_POST['r_lastName'])) {
    $rmsc->roomReservationDataClass->setLastName($_POST['r_lastName']);
}

if (isset($_POST['r_firstName'])) {
    $rmsc->roomReservationDataClass->setFirstName($_POST['r_firstName']);
}

if (isset($_POST['r_schoolYear'])) {
    $rmsc->roomReservationDataClass->setSchoolYear($_POST['r_schoolYear']);
}

if (isset($_POST['r_className'])) {
    $rmsc->roomReservationDataClass->setClassCode($rmsc->classNameArray[$_POST['r_className']]);
}

if (isset($_POST['r_roomName'])) {
    $rmsc->roomReservationDataClass->setRoomCode($rmsc->roomNameArray[$_POST['r_roomName']]);
}

if (isset($_POST['r_leavingTimeHour'])) {
    $rmsc->roomReservationDataClass->setLeavingHour($_POST['r_leavingHour']);
}

if (isset($_POST['r_leavingTimeMinute'])) {
    $rmsc->roomReservationDataClass->setLeavingMinute($_POST['r_leavingMinute']);
}

if (isset($_POST['r_reasonName'])) {
    $rmsc->roomReservationDataClass->setReasonCode($rmsc->reasonNameArray[$_POST['r_reasonName']]);
}

if (isset($_POST['r_entryTeacherCode'])) {
    $rmsc->roomReservationDataClass->setEntryTeacherCode($_POST['r_entryTeacherCode']);
}

if (isset($_POST['insert'])) {
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
