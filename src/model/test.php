<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
  <?php
  require "./DataController.php";
  ?>
  <meta charset="utf-8">
  <title></title>
</head>

<body>
  <?php
  $dc = new DataController();
  $dc->fetchSelectDatas();
  //$dc->refreshData();
  // 部屋名の連想配列
  echo 'fetchRoomNameArray<br>';
  foreach ((array) $dc->roomNameArray as $key => $value) {
    echo $key . '   ' . $value . '<br>';
  }
  // 学科名の連想配列
  echo '<br>fetchClassNameArray<br>';
  foreach ((array) $dc->classNameArray as $key => $value) {
    echo $key . '   ' . $value . '<br>';
  }
  // 理由の連想破裂
  echo '<br>fetchReasonNameArray<br>';
  foreach ((array) $dc->reasonNameArray as $key => $value) {
    echo $key . '   ' . $value . '<br>';
  }

  // 教室利用予約クラス
  $dc->createroomReservationDataClass();
  // $dc->roomReservationDataClass->setName("ナカヤマ", "ヤマト");
  // $dc->roomReservationDataClass->setClassCode($dc->classNameArray['IT学科']);
  // $dc->roomReservationDataClass->setSchoolYear(3);
  // $dc->roomReservationDataClass->setRoomCode($dc->roomNameArray['412']);
  // $dc->roomReservationDataClass->setLeavingTime(15, 15);
  // $dc->roomReservationDataClass->setReasonCode($dc->reasonNameArray['就活']);
  // $dc->roomReservationDataClass->setEntryTeacherCode(10001);

  ?>

  <div>
    <form action="" method="post">
      <input type="text" name="r_lastName" id="1" value="ヤマト">
      <input type="text" name="r_firstName" id="2" value="ナカヤマ">
      <input type="text" name="r_schoolYear" id="3" value="3">
      <input type="text" name="r_className" id="4" value="IT学科">
      <input type="text" name="r_roomName" id="5" value="412">
      <input type="text" name="r_leavingHour" id="6" value="15">
      <input type="text" name="r_leavingMinute" id="7" value="15">
      <input type="text" name="r_reasonName" id="8" value="就活">
      <input type="text" name="r_entryTeacherCode" id="9" value="10001">
      <input type="submit" name="insert" value="予約">
    </form>
  </div>

  <?php

  require 'RESERVATION_POST.php';

  echo '<br>roomReservationDataClass<br>';
  echo 'Name:' . $dc->roomReservationDataClass->getName() . '<br>';
  echo 'ClassCode:' . $dc->roomReservationDataClass->getClassCode() . '<br>';
  echo 'ShoolYear:' . $dc->roomReservationDataClass->getSchoolYear() . '<br>';
  echo 'UseRoom:' . $dc->roomReservationDataClass->getRoomCode() . '<br>';
  echo 'LeavingTime' . date_format($dc->roomReservationDataClass->getLeavingTime(), ('H:i:s')) . '<br>';
  echo 'Reason:' . $dc->roomReservationDataClass->getReasonCode() . '<br>';
  echo 'EntryTeacherCode:' . $dc->roomReservationDataClass->getEntryTeacherCode() . '<br>';
  echo 'StudentNumber:' . DataBaseController::getStudentNumber(
    $dc->roomReservationDataClass->getName(),
    $dc->roomReservationDataClass->getClassCode(),
    $dc->roomReservationDataClass->getSchoolYear()
  ) . '<br>';

  // 教室退室クラス
  $dc->createLeaveDataClass();
  // $dc->leaveDataClass->setName("ナカヤマ", "ヤマト");
  // $dc->leaveDataClass->setSchoolYear(3);
  // $dc->leaveDataClass->setClassCode(1);
  // $dc->leaveDataClass->setLeavingTeacherCode(10001);
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
  echo 'Name:' . $dc->leaveDataClass->getName() . '<br>';
  echo 'SchoolYear:' . $dc->leaveDataClass->getSchoolYear() . '<br>';
  echo 'ClassCode:' . $dc->leaveDataClass->getClassCode() . '<br>';
  echo 'LeavingTeacherCode:' . $dc->leaveDataClass->getLeavingTeacherCode() . '<br>';
  // if (DataBaseController::searchLeaveData($dc->leaveDataClass)) {
  //   echo  'データが存在します。<br>';
  // } else {
  //   echo  'データが存在しません。<br>';
  // }
  // if ($dc->cheackLeaveDataClass()) {
  //   echo 'OK<br>';
  // } else {
  //   echo 'NO<br>';
  // }


  echo '<br><div>ログデータ</div>';
  $logDataClassAraay = DataBaseController::fetchLogData();
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
  foreach ((array) $logDataClassAraay as $buff) {
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
  echo '</table><br><br><br>';
  ?>
  <div>
  </div>
  <div>学科</div>
  <select tabindex="-1" name="" id="" class="c-comboBox c-comboBox--course u-fz3 u-lh5">
    <?php $dc->setCmbClassName() ?>
  </select>
  <div>教室名</div>
  <select tabindex="-1" name="" id="" class="c-comboBox c-comboBox--course u-fz3 u-lh5">
    <?php $dc->setCmbRoomName() ?>
  </select>
  <div>理由名</div>
  <select tabindex="-1" name="" id="" class="c-comboBox c-comboBox--course u-fz3 u-lh5">
    <?php $dc->setCmbReasonName() ?>
  </select>


  <form action="" method="post">
    <div><input type="submit" name="Refresh" value="Refresh"></div>
  </form>
</body>

</html>
<?php

if (isset($_POST['Refresh'])) {
  $dc->refreshData();
}
?>