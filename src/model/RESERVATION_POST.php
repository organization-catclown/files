<?php

if (isset($_POST['r_lastName'])) {
    $dc->roomReservationDataClass->setLastName($_POST['r_lastName']);
}

if (isset($_POST['r_firstName'])) {
    $dc->roomReservationDataClass->setFirstName($_POST['r_firstName']);
}

if (isset($_POST['r_schoolYear'])) {
    $dc->roomReservationDataClass->setSchoolYear($_POST['r_schoolYear']);
}

if (isset($_POST['r_className'])) {
    $dc->roomReservationDataClass->setClassCode($dc->classNameArray[$_POST['r_className']]);
}

if (isset($_POST['r_roomName'])) {
    $dc->roomReservationDataClass->setRoomCode($dc->roomNameArray[$_POST['r_roomName']]);
}

if (isset($_POST['r_leavingTimeHour'])) {
    $dc->roomReservationDataClass->setLeavingHour($_POST['r_leavingHour']);
}

if (isset($_POST['r_leavingTimeMinute'])) {
    $dc->roomReservationDataClass->setLeavingMinute($_POST['r_leavingMinute']);
}

if (isset($_POST['r_reasonName'])) {
    $dc->roomReservationDataClass->setReasonCode($dc->reasonNameArray[$_POST['r_reasonName']]);
}

if (isset($_POST['r_entryTeacherCode'])) {
    $dc->roomReservationDataClass->setEntryTeacherCode($_POST['r_entryTeacherCode']);
}

if (isset($_POST['insert'])) {
    if ($dc->checkRoomReservationDataClass()) {
        if (!DataBaseController::doubleCheck($dc->roomReservationDataClass)) {
            DataBaseController::insertReservationData($dc->roomReservationDataClass);
        }
    }
}
