<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
  <?php
  require "./RMSController.php";
  ?>
  <meta charset="utf-8">
  <title></title>
</head>

<body>
  <div>
    <?php
    $rmsc = new RMSController();
    $rmsc->fetchSelectDatas();
    //$rmsc->refreshData();
    // 部屋名の連想配列
    echo 'fetchRoomNameArray<br>';
    foreach ((array) $rmsc->roomNameArray as $key => $value) {
      echo $key . '   ' . $value . '<br>';
    }
    // 学科名の連想配列
    echo '<br>fetchClassNameArray<br>';
    foreach ((array) $rmsc->classNameArray as $key => $value) {
      echo $key . '   ' . $value . '<br>';
    }
    // 理由の連想破裂
    echo '<br>fetchReasonNameArray<br>';
    foreach ((array) $rmsc->reasonNameArray as $key => $value) {
      echo $key . '   ' . $value . '<br>';
    }

    // 教室利用予約クラス
    $rmsc->createroomReservationDataClass();
    // $rmsc->roomReservationDataClass->setName("ナカヤマ", "ヤマト");
    // $rmsc->roomReservationDataClass->setClassCode($rmsc->classNameArray['IT学科']);
    // $rmsc->roomReservationDataClass->setSchoolYear(3);
    // $rmsc->roomReservationDataClass->setRoomCode($rmsc->roomNameArray['412']);
    // $rmsc->roomReservationDataClass->setLeavingTime(15, 15);
    // $rmsc->roomReservationDataClass->setReasonCode($rmsc->reasonNameArray['就活']);
    // $rmsc->roomReservationDataClass->setEntryTeacherCode(10001);

    ?>

    <div>
      <form action="" method="post">
        <input type="text" name="r_lastName" id="1" value="ヤマト">
        <input type="text" name="r_firstName" id="2" value="ナカヤマ">
        <input type="text" name="r_schoolYear" id="3" value="3">
        <input type="text" name="r_className" id="4" value="IT学科">
        <input type="text" name="r_roomName" id="5" value="412">
        <input type="text" name="r_leavingTimeHour" id="6" value="15">
        <input type="text" name="r_leavingTimeMinute" id="7" value="15">
        <input type="text" name="r_reason" id="8" value="就活">
        <input type="text" name="r_entryTeacherCode" id="9" value="10001">
        <input type="submit" name="insert" value="予約">
      </form>
    </div>

    <?php

    require 'RESERVATION_POST.php';

    echo '<br>roomReservationDataClass<br>';
    echo 'Name:' . $rmsc->roomReservationDataClass->getName() . '<br>';
    echo 'ClassCode:' . $rmsc->roomReservationDataClass->getClassCode() . '<br>';
    echo 'ShoolYear:' . $rmsc->roomReservationDataClass->getSchoolYear() . '<br>';
    echo 'UseRoom:' . $rmsc->roomReservationDataClass->getRoomCode() . '<br>';
    echo 'LeavingTime' . date_format($rmsc->roomReservationDataClass->getLeavingTime(), ('H:i:s')) . '<br>';
    echo 'Reason:' . $rmsc->roomReservationDataClass->getReasonCode() . '<br>';
    echo 'EntryTeacherCode:' . $rmsc->roomReservationDataClass->getEntryTeacherCode() . '<br>';
    echo 'StudentNumber:' . DataBaseController::getStudentNumber(
      $rmsc->roomReservationDataClass->getName(),
      $rmsc->roomReservationDataClass->getClassCode(),
      $rmsc->roomReservationDataClass->getSchoolYear()
    ) . '<br>';

    // 教室退室クラス
    $rmsc->createLeaveDataClass();
    // $rmsc->leaveDataClass->setName("ナカヤマ", "ヤマト");
    // $rmsc->leaveDataClass->setSchoolYear(3);
    // $rmsc->leaveDataClass->setClassCode(1);
    // $rmsc->leaveDataClass->setLeavingTeacherCode(10001);
    ?>
    <div>
      <form action="" method="post">
        <input type="text" name="l_firstName" id="1" value="ナカヤマ">
        <input type="text" name="l_lastName" id="2" value="ヤマト">
        <input type="text" name="l_schoolYear" id="3" value="3">
        <input type="text" name="l_className" id="4" value="IT学科">
        <input type="text" name="l_leavingTeacherCode" id="5" value="10001">
        <input type="submit" name="leave" value="退室">
      </form>
    </div>
    <?php

    require 'LEAVE_POST.php';

    echo '<br>LeaveDataClass<br>';
    echo 'Name:' . $rmsc->leaveDataClass->getName() . '<br>';
    echo 'SchoolYear:' . $rmsc->leaveDataClass->getSchoolYear() . '<br>';
    echo 'ClassCode:' . $rmsc->leaveDataClass->getClassCode() . '<br>';
    echo 'LeavingTeacherCode:' . $rmsc->leaveDataClass->getLeavingTeacherCode() . '<br>';
    // if (DataBaseController::searchLeaveData($rmsc->leaveDataClass)) {
    //   echo  'データが存在します。<br>';
    // } else {
    //   echo  'データが存在しません。<br>';
    // }
    // if ($rmsc->cheackLeaveDataClass()) {
    //   echo 'OK<br>';
    // } else {
    //   echo 'NO<br>';
    // }


    echo '<br><div>ログデータ</div>';
    $rmsc->showLogData();

    echo '</table><br><br><br>';
    ?>
    <div>
    </div>
    <div>学科</div>
    <select tabindex="-1" name="" id="" class="c-comboBox c-comboBox--course u-fz3 u-lh5">
      <?php $rmsc->setCmbClassName() ?>
    </select>
    <div>教室名</div>
    <select tabindex="-1" name="" id="" class="c-comboBox c-comboBox--course u-fz3 u-lh5">
      <?php $rmsc->setCmbRoomName() ?>
    </select>
    <div>理由名</div>
    <select tabindex="-1" name="" id="" class="c-comboBox c-comboBox--course u-fz3 u-lh5">
      <?php $rmsc->setCmbReasonName() ?>
    </select>


    <form action="" method="post">
      <div><input type="submit" name="Refresh" value="Refresh"></div>
    </form>
    <form action="" method="post">
      <div><input type="submit" name="searchRMS" value="未退室検出"></div>
    </form>


  </div>
  <?php
      if (isset($_POST['searchRMS'])) {
        if (DataBaseController::searchRoomManagements()) {
          $alert = "<script type='text/javascript'>alert('未退室の生徒が存在します。');</script>";
          echo $alert;
        } else {
          $alert = "<script type='text/javascript'>alert('未退室の生徒はいません。');</script>";
          echo $alert;
        }
      }

      if (isset($_POST['Refresh'])) {
        $rmsc->refreshData();
      }
  ?>
</body>

</html>