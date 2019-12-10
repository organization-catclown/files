<?php
define('USER', 'root');
define('PASS', '');
define('DSN', 'mysql:host=localhost;dbname=RoomManagementSystem;charset=utf8');

/**
 * データベースへの接続をして
 * データの取得、挿入、削除するためのクラス
 */
class DataBaseController
{

    /**
     * 教室利用予約時、生徒の名前がStudents表に存在するかチェック
     * @param RoomReservationDataClass $roomReservationDataClass
     * @return boolean 存在すればTRUE、存在しなければFALSE
     */
    public static function searchStudentData($roomReservationDataClass)
    {
        $pdo = null;
        $stmt = null;
        try {
            $pdo = new PDO(DSN, USER, PASS);
            $sql = "SELECT COUNT(StudentNumber) as HIT FROM Students
              WHERE ClassCode = :classCode AND SchoolYear = :schoolYear
              AND Name2 = :name2";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':classCode', $roomReservationDataClass->getClassCode(), PDO::PARAM_INT);
            $stmt->bindParam(':schoolYear', $roomReservationDataClass->getSchoolYear(), PDO::PARAM_INT);
            $stmt->bindParam(':name2', $roomReservationDataClass->getName(), PDO::PARAM_STR);

            $stmt->execute();

            $result = $stmt->fetch();

            if ($result['HIT'] == 1) {
                return true;
            }
            $stmt = null;
            $pdo = null;
        } catch (Exception $e) {
            print "エラー：" . $e->getMessage() . "<br>";
        } finally {
            if ($stmt != null) {
                $stmt = null;
            }
            if ($pdo != null) {
                $pdo = null;
            }
        }
        return false;
    }

    /**
     * 退室時、生徒の名前がRoomManagements表に存在するかチェック
     * @param LeaveDataClass $leaveDataClass
     * @return boolean 存在すればTRUE、存在しなければFALSE
     */
    public static function searchLeaveData($leaveDataClass)
    {
        $pdo = null;
        $stmt = null;
        $studentNumber = self::getStudentNumber($leaveDataClass->getName(), $leaveDataClass->getClassCode(), $leaveDataClass->getSchoolYear());
        try {
            $pdo = new PDO(DSN, USER, PASS);
            $sql = "SELECT COUNT(*) as HIT FROM RoomManagements WHERE EndFlag = FALSE AND StudentNumber = :studentNumber";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':studentNumber', $studentNumber, PDO::PARAM_INT);

            $stmt->execute();

            $result = $stmt->fetch();

            if ($result['HIT'] == 1) {
                return true;
            }

            $stmt = null;
            $pdo = null;
        } catch (Exception $e) {
            print "エラー：" . $e->getMessage() . "<br>";
        } finally {
            if ($stmt != null) {
                $stmt = null;
            }
            if ($pdo != null) {
                $pdo = null;
            }
        }
        return false;
    }

    /**
     * 同じ人が複数回利用しないようにする為の重複チェック
     * @param RoomReservationDataClass $roomReservationDataClass
     * @return boolean 重複が確認されればtrue、確認されなければfalse
     */
    public static function doubleCheck($roomReservationDataClass)
    {
        $pdo = null;
        $stmt = null;
        $studentNumber = self::getStudentNumber($roomReservationDataClass->getName(), $roomReservationDataClass->getClassCode(), $roomReservationDataClass->getSchoolYear());
        try {
            $pdo = new PDO(DSN, USER, PASS);
            $sql = "SELECT COUNT(*) as HIT FROM RoomManagements WHERE EndFlag = FALSE AND StudentNumber = :studentNumber";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':studentNumber', $studentNumber, PDO::PARAM_INT);

            $stmt->execute();

            $result = $stmt->fetch();

            if ($result['HIT'] == 1) {
                return true;
            }

            $stmt = null;
            $pdo = null;
        } catch (Exception $e) {
            print "エラー：" . $e->getMessage() . "<br>";
        } finally {
            if ($stmt != null) {
                $stmt = null;
            }
            if ($pdo != null) {
                $pdo = null;
            }
        }
        return false;
    }

    /** 
     * 教室利用予約のためのインサート文
     * @param RoomReservationDataClass $roomReservationDataClass 
     */
    public static function insertReservationData($roomReservationDataClass)
    {
        $pdo = null;
        $stmt = null;
        $studentNumber = self::getStudentNumber($roomReservationDataClass->getName(), $roomReservationDataClass->getClassCode(), $roomReservationDataClass->getSchoolYear());
        $roomCode = $roomReservationDataClass->getRoomCode();
        $entryTeacherCode = $roomReservationDataClass->getEntryTeacherCode();
        $leavingTime = date_format($roomReservationDataClass->getLeavingTime(), ('H:i:s'));
        $reasonCode = $roomReservationDataClass->getReasonCode();
        try {
            $pdo = new PDO(DSN, USER, PASS);
            $sql = "INSERT INTO RoomManagements
              VALUES(:studentNumber,:roomCode,:entryTeacherCode,NOW(),NULL,
              :leavingTime,:reasonCode,NULL,false);";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':studentNumber', $studentNumber, PDO::PARAM_INT);
            $stmt->bindParam(':roomCode', $roomCode, PDO::PARAM_INT);
            $stmt->bindParam(':entryTeacherCode', $entryTeacherCode, PDO::PARAM_INT);
            $stmt->bindParam(':leavingTime', $leavingTime, PDO::PARAM_STR);
            $stmt->bindParam(':reasonCode', $reasonCode, PDO::PARAM_INT);

            $stmt->execute();

            $stmt = null;
            $pdo = null;
        } catch (Exception $e) {
            print "エラー：" . $e->getMessage() . "<br>";
        } finally {
            if ($stmt != null) {
                $stmt = null;
            }
            if ($pdo != null) {
                $pdo = null;
            }
        }
    }

    /**
     * 退室用のアップデート文
     * @param LeaveDataClass $leaveDataClass
     */
    public static function leaveRoom($leaveDataClass)
    {
        $pdo = null;
        $stmt = null;
        $studentNumber = self::getStudentNumber($leaveDataClass->getName(), $leaveDataClass->getClassCode(), $leaveDataClass->getSchoolYear());
        $teacherCode = $leaveDataClass->getLeavingTeacherCode();
        try {
            $pdo = new PDO(DSN, USER, PASS);
            $sql = "UPDATE RoomManagements 
            SET LeavingTeacherCode = :teacherCode, EndDate = NOW(), EndFlag = true 
            WHERE EndFlag = false AND StudentNumber = :studentNumber";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':teacherCode', $teacherCode, PDO::PARAM_INT);
            $stmt->bindParam(':studentNumber', $studentNumber, PDO::PARAM_STR);
            $stmt->execute();

            $stmt = null;
            $pdo = null;
        } catch (Exception $e) {
            print "エラー：" . $e->getMessage() . "<br>";
        } finally {
            if ($stmt != null) {
                $stmt = null;
            }
            if ($pdo != null) {
                $pdo = null;
            }
        }
    }

    /**
     * コンボボックスに入れる部屋名を配列で取得取得
     * @return $roomNameArray　Key=部屋名 Value=部屋コードの連想配列
     */
    public static function fetchRoomData()
    {
        $pdo = null;
        $stmt = null;
        $roomNameArray = null;
        try {
            $pdo = new PDO(DSN, USER, PASS);
            $stmt = $pdo->query("SELECT * FROM Rooms");
            foreach ($stmt as $row) {
                $roomNameArray[$row['RoomName']] = $row['RoomCode'];
            }
            $stmt = null;
            $pdo = null;
        } catch (Exception $e) {
            print "エラー：" . $e->getMessage() . "<br>";
        } finally {
            if ($stmt != null) {
                $stmt = null;
            }
            if ($pdo != null) {
                $pdo = null;
            }
            return $roomNameArray;
        }
    }

    /**
     * コンボボックスに入れる学科名を取得する
     * @return $classNameArray Key=クラス名 Value=部屋コードの連想配列
     */
    public static function fetchClassData()
    {
        $pdo = null;
        $stmt = null;
        $classNameArray = null;
        try {
            $pdo = new PDO(DSN, USER, PASS);
            $stmt = $pdo->query("SELECT * FROM Classes");
            foreach ($stmt as $row) {
                $classNameArray[$row['ClassName']] = $row['ClassCode'];
            }
            $stmt = null;
            $pdo = null;
        } catch (Exception $e) {
            print "エラー：" . $e->getMessage() . "<br>";
        } finally {
            if ($stmt != null) {
                $stmt = null;
            }
            if ($pdo != null) {
                $pdo = null;
            }
            return $classNameArray;
        }
    }

    /**
     * コンボボックスの中に入れる教室利用の理由を取得する
     * @return $reasonArray Key=理由 Value=理由コードの連想配列
     * 
     */
    public static function fetchReasonData()
    {
        $pdo = null;
        $stmt = null;
        $reasonArray = null;
        try {
            $pdo = new PDO(DSN, USER, PASS);
            $stmt = $pdo->query("SELECT * FROM Reasons");
            foreach ($stmt as $row) {
                $reasonArray[$row['Reason']] = $row['ReasonCode'];
            }
            $stmt = null;
            $pdo = null;
        } catch (Exception $e) {
            print "エラー：" . $e->getMessage() . "<br>";
        } finally {
            if ($stmt != null) {
                $stmt = null;
            }
            if ($pdo != null) {
                $pdo = null;
            }
            return $reasonArray;
        }
    }

    /**
     * 教員用メニューのログデータを配列で取得する
     * @return array $ldcArray LogDataClassの配列
     */
    public static function fetchLogData()
    {
        $pdo = null;
        $stmt = null;
        $ldcArray = null;   //LogDataClassの配列
        try {
            $pdo = new PDO(DSN, USER, PASS);
            $stmt = $pdo->query("SELECT * FROM RoomManagements");
            $ldcArray = array();
            foreach ($stmt as $row) {
                $ldc = new LogDataClass();
                $ldc->setStudentNumber($row['StudentNumber']);
                $ldc->setRoomCode($row['RoomCode']);
                $ldc->setEntryTeacherCode($row['EntryTeacherCode']);
                $ldc->setEntryTime($row['EntryTime']);
                $ldc->setLeavingTeacherCode($row['LeavingTeacherCode']);
                $ldc->setLeavingTime($row['LeavingTime']);
                $ldc->setReasonCode($row['ReasonCode']);
                $ldc->setEndDate($row['EndDate']);
                $ldc->setEndFlag($row['EndFlag']);
                array_push($ldcArray, $ldc);
            }

            $stmt = null;
            $pdo = null;
        } catch (Exception $e) {
            print "エラー：" . $e->getMessage() . "<br>";
        } finally {
            if ($stmt != null) {
                $stmt = null;
            }
            if ($pdo != null) {
                $pdo = null;
            }
        }
        return $ldcArray;
    }

    /**
     * コンボボックスの中に入れる使用可能教室名を配列で取得する
     * @param int $classcode
     * @return $array クラスコードと利用可能クラスコードの＆演算の結果で使用可能か判断した部屋名を格納した配列
     */
    public static function checkPermissionRoom($classCode)
    {
        $array = array();
        $pdo = null;
        $stmt = null;
        try {
            $pdo = new PDO(DSN, USER, PASS);
            $sql = "SELECT RoomName, AvailableClass FROM Rooms";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            foreach ($stmt as $row) {
                if ($row['AvailableClass'] & $classCode > 0) {
                    array_push($array, $row['RoomName']);
                }
            }
            $stmt = null;
            $pdo = null;
        } catch (Exception $e) {
            print "エラー：" . $e->getMessage() . "<br>";
        } finally {
            if ($stmt != null) {
                $stmt = null;
            }
            if ($pdo != null) {
                $pdo = null;
            }
        }
        return $array;
    }

    /**
     * 受け取った教師番号から教師名を取得します
     * @param int $teacherCode
     * @return $teacherName 教師名
     */
    public static function getTeacherName($teacherCode)
    {
        $pdo = null;
        $stmt = null;
        $teacherName = null;
        try {
            $pdo = new PDO(DSN, USER, PASS);
            $sql = "SELECT TeacherName FROM Teachers WHERE TeacherCode = :teachercode";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':teachercode', $teacherCode, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $teacherName = $result['TeacherName'];

            $stmt = null;
            $pdo = null;
        } catch (Exception $e) {
            print "エラー：" . $e->getMessage() . "<br>";
        } finally {
            if ($stmt != null) {
                $stmt = null;
            }
            if ($pdo != null) {
                $pdo = null;
            }
            return $teacherName;
        }
    }

    /**
     * 受け取った名前（カタカナ）、クラスコード、学年から学生番号を取得する
     * @param string $studentName
     * @param int $classcode
     * @param int $schoolYear
     * @return $studentNumber 学生番号
     */
    public static function getStudentNumber($studentName, $classcode, $schoolyear)
    {
        $pdo = null;
        $stmt = null;
        $studentnumber = null;
        try {
            $pdo = new PDO(DSN, USER, PASS);
            $sql = "SELECT StudentNumber FROM Students
              WHERE ClassCode = :classCode AND SchoolYear = :schoolYear
              AND Name2 = :name2";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':classCode', $classcode, PDO::PARAM_INT);
            $stmt->bindParam(':schoolYear', $schoolyear, PDO::PARAM_INT);
            $stmt->bindParam(':name2', $studentName, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $studentnumber = $result['StudentNumber'];

            $stmt = null;
            $pdo = null;
        } catch (Exception $e) {
            print "エラー：" . $e->getMessage() . "<br>";
        } finally {
            if ($stmt != null) {
                $stmt = null;
            }
            if ($pdo != null) {
                $pdo = null;
            }
            return $studentnumber;
        }
    }
}
