<?php
//error_reporting(0);
/**
 * RoomManagementSystem用の
 */
class RoomManagementClass{
  public $user;
  public $pass;
  public $dsn;

  public function __construct(){
    $user = 'root';
    $pass = '';
    $dsn = 'mysql:host=localhost;dbname=RoomManagementSystem;charset=utf8';
    echo 'Constructor<br>';
    echo $user . '<br>';
    echo $pass . '<br>';
    echo $dsn . '<br>';
  }

  public function LeaveView(){
    echo "Function LeaveView<br>";
    $stmt = null;
    $pdo = null;
    try{
      $pdo = new PDO($this->dsn,$this->user,$this->pass);
      echo "new PDO<br>";
      $stmt = $pdo->query('SELECT * FROM leaveview;');
      $num = 1;
      foreach($stmt as $row){
        echo '<tr style="height:50px;">';
        echo '<td id=name' . $num .'>' . $row['Name'] . '</td>';
        echo '<td id=classname' . $num .'>' . $row['ClassName'] . '</td>';
        echo '<td id=roomname' . $num .'>' . $row['RoomName'] . '</td>';
        echo '<td id=leavetime' . $num .'>' . $row['LeaveTime'] . '</td>';
        echo '<td id=leaveButton><input type="button" id=' . $num .' value="退室"></td>';
        echo '</tr>';
        $num++;
      }
      $stmt = null;
      $pdo = null;
    }catch (Exception $e){
      print "エラー：" . $e->getMessage() . "<br>";
    }finally{
      if($stmt != null){
        $stmt = null;
      }
      if($pdo != null){
        $pdo = null;
      }
    }
  }
/*
  public function LeaveProcess($name,$roomName){
    $stmt = null;
    $pdo = null;
    try{
      $pdo = "";
      $pdo = new PDO($this->dsn,$this->uesr,$this->pass);
      $stmt = $pdo->prepare('UPDATE RoomManagements SET EndFlag = TRUE WHERE EndFlag = FALSE AND Name = :name AND RoomName = :roomName');
      $params = array('name' => name, 'RoomName' => roomName);
      $stmt->execute($params);
      }
      $stmt = null;
      $pdo = null;
    }catch (Exception $e){
      print "エラー：" . $e->getMessage() . "<br>";
    }
  }
*/
  /*
  public function LogAllData(){
    try{
      $pdo = "";
      $pdo = new PDO($this->dsn,$this->uesr,$this->pass);
      $stmt = $pdo->query('SELECT * FROM RoomManagements;');
      $num = 1;

      foreach($stmt as $row){

        $num++;
      }
      $stmt = null;
      $pdo = null;
    }catch (Exception $e){
      print "エラー：" . $e->getMessage() . "<br>";
    }
  }
  */
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
    $rmc = new RoomManagementClass();
     ?>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table>
      <tr>
        <th>名前</th>
        <th>学科名</th>
        <th>使用教室</th>
        <th>退室予定時間</th>
        <th>退室ボタン</th>
      </tr>
      <?php
      $rmc->LeaveView();
      ?>

    </table>

  </body>
</html>
