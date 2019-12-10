<?php
if (isset($_POST['l_firstName'])) {
    $dc->leaveDataClass->setFirstName($_POST['l_firstName']);
}
if (isset($_POST['l_lastName'])) {
    $dc->leaveDataClass->setLastName($_POST['l_lastName']);
}
if (isset($_POST['l_schoolYear'])) {
    $dc->leaveDataClass->setSchoolYear($_POST['l_schoolYear']);
}
if (isset($_POST['l_className'])) {
    $dc->leaveDataClass->setClassCode($dc->classNameArray[$_POST['l_className']]);
}
if (isset($_POST['l_leavingTeacherCode'])) {
    $dc->leaveDataClass->setLeavingTeacherCode($_POST['l_leavingTeacherCode']);
}

if (isset($_POST['leave'])) {
    if (DataBaseController::searchLeaveData($dc->leaveDataClass)) {
        echo  'データが存在します。<br>';
        if ($dc->cheackLeaveDataClass()) {
            DataBaseController::leaveRoom($dc->leaveDataClass);
        }
    }
}
