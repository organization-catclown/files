<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
  <?php
  require "./model/DataController.php"
  ?>
  <meta charset="utf-8">
  <title></title>
</head>

<body>
  <?php
  $dc = new DataController();
  $dc->fetchSelectDatas();
  $dc->refreshData();
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
  $dc->roomReservationDataClass->setName("ナカヤマ", "ヤマト");
  $dc->roomReservationDataClass->setClassCode($dc->classNameArray['IT学科']);
  $dc->roomReservationDataClass->setSchoolYear(3);
  $dc->roomReservationDataClass->setUseRoom($dc->roomNameArray['412']);
  $dc->roomReservationDataClass->setLeavingTime(15, 15);
  $dc->roomReservationDataClass->setReasonCode($dc->reasonNameArray['就活']);
  $dc->roomReservationDataClass->setEntryTeacherCode(10001);

  echo '<br>roomReservationDataClass<br>';
  echo 'Name:' . $dc->roomReservationDataClass->getName() . '<br>';
  echo 'ClassCode:' . $dc->roomReservationDataClass->getClassCode() . '<br>';
  echo 'ShoolYear:' . $dc->roomReservationDataClass->getSchoolYear() . '<br>';
  echo 'UseRoom:' . $dc->roomReservationDataClass->getUseRoom() . '<br>';
  echo 'LeavingTime' . date_format($dc->roomReservationDataClass->getLeavingTime(), ('H:i:s')) . '<br>';
  echo 'Reason:' . $dc->roomReservationDataClass->getReasonCode() . '<br>';
  echo 'EntryTeacherCode:' . $dc->roomReservationDataClass->getEntryTeacherCode() . '<br>';
  echo 'StudentNumber:' . DataBaseController::getStudentNumber(
    $dc->roomReservationDataClass->getName(),
    $dc->roomReservationDataClass->getClassCode(),
    $dc->roomReservationDataClass->getSchoolYear()
  ) . '<br>';
  if ($dc->checkRoomReservationDataClass()) {
    echo 'OK<br>';
  } else {
    echo 'NO<br>';
  }

  // 教室退室クラス
  $dc->createLeaveDataClass();
  $dc->leaveDataClass->setName("ナカヤマ", "ヤマト");
  $dc->leaveDataClass->setSchoolYear(3);
  $dc->leaveDataClass->setClassCode(1);
  $dc->leaveDataClass->setLeavingTeacherCode(10001);
  echo '<br>LeaveDataClass<br>';
  echo $dc->leaveDataClass->getName() . '<br>';
  echo $dc->leaveDataClass->getSchoolYear() . '<br>';
  echo $dc->leaveDataClass->getClassCode() . '<br>';
  if (DataBaseController::searchLeaveData($dc->leaveDataClass)) {
    echo  'データが存在します。<br>';
  } else {
    echo  'データが存在しません。<br>';
  }
  if ($dc->cheackLeavingDataClass()) {
    echo 'OK<br>';
  } else {
    echo 'NO<br>';
  }


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
    <form action="" method="get">
      <div><input type="submit" name="Insert" value="Insert"></div>
      <div><input type="submit" name="Leave" value="Leave"></div>
      <div><input type="submit" name="Refresh" value="Refresh"></div>
    </form>
  </div>

</body>

</html>
<?php
if (isset($_GET['Insert'])) {
  if (!DataBaseController::doubleCheck($dc->roomReservationDataClass)) {
    DataBaseController::insertReservationData($dc->roomReservationDataClass);
  }
}
if (isset($_GET['Leave'])) {
  DataBaseController::leavingRoom($dc->leaveDataClass);
}
if (isset($_GET['Refresh'])) {
  $dc->refreshData();
}
?>