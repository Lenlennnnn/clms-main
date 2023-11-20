<?php

declare(strict_types=1);
class Logs
{
    private $conn;
    public $pc_number, $srcodeid, $fullname, $department, $course, $lab_name, $timein, $date, $facultyName, $subject, $section, $purpose, $sessionCode;

    public $lab_id, $pc_id, $timeOut;

    public $gender, $birthdate, $address;
    public $startdate, $enddate;
    public $log_id;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function timeInLogs()
    {
        $checkuser = $this->conn->prepare("SELECT * FROM clms_pc INNER JOIN clms_laboratories ON clms_pc.laboratory_id = clms_laboratories.laboratory_id WHERE user_srcode = ?");
        $checkuser->execute([$this->srcodeid]);
        if ($checkuser->rowCount() === 0) {
            $sqlQuery = "UPDATE clms_pc SET status = 'occupied', user_srcode = ?, date = ?, time = ?, session_code = ? WHERE id = ? AND laboratory_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute(array($this->srcodeid, $this->date, $this->timein, $this->sessionCode, $this->pc_id, $this->lab_id));
            $rowCount = $stmt->rowCount();
            $stmt->closeCursor();

            if ($rowCount > 0) {
                $insertsql = "INSERT INTO `clms_logs`( `srcode`, `fullname`, `session_code`, `laboratory_id`, `laboratory_name`, `timein`, `date`, `faculty_name`, `subject`, `section`, `pc_number`, `department`, `course`, `purpose`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->conn->prepare($insertsql);
                $stmt->execute(array($this->srcodeid, $this->fullname, $this->sessionCode, $this->lab_id, $this->lab_name, $this->timein, $this->date, $this->facultyName, $this->subject, $this->section, $this->pc_number, $this->department, $this->course, $this->purpose));
                $stmt->closeCursor();
                if ($stmt) {
                    return "Success";
                } else {
                    return "Failed";
                }
            } else {
                return "Failed";
            }
        } else {
            $existingresult = $checkuser->fetchAll(PDO::FETCH_ASSOC);
            return $existingresult;
        }
    }

    // public function timeOutLogs()
    // {
    //     $sqlQuery = "UPDATE clms_pc SET status = 'available', user_srcode = NULL, date = NULL, time = NULL WHERE id = ? AND laboratory_id = ?";
    //     $stmt = $this->conn->prepare($sqlQuery);
    //     $stmt->execute(array($this->pc_id, $this->lab_id));
    //     $stmt->closeCursor();

    //     if ($stmt) {
    //         $timeoutsql = "UPDATE `clms_logs` SET `timeout`= ? WHERE pc_number = ?   AND srcode = ? AND date = ? AND timein = ? AND laboratory_id = ?";
    //         $stmt = $this->conn->prepare($timeoutsql);
    //         $stmt->execute(array($this->timeOut, $this->pc_number, $this->srcodeid, $this->date, $this->timein, $this->lab_id));
    //         if ($stmt) {
    //             return "Success";
    //         } else {
    //             return "Failed";
    //         }

    //     }

    // }

    public function timeOutLogs()
    {
        if (is_array($this->pc_id)) {

            $pc_id = implode(',', array_map(function ($value) {
                return "'" . $value . "'";
            }, $this->pc_id));
            $pc_number = implode(',', array_map(function ($value) {
                return "'" . $value . "'";
            }, $this->pc_number));
            $date = implode(',', array_map(function ($value) {
                return "'" . $value . "'";
            }, $this->date));
            $srcodeid = implode(',', array_map(function ($value) {
                return "'" . $value . "'";
            }, $this->srcodeid));
            $timein = implode(',', array_map(function ($value) {
                return "'" . $value . "'";
            }, $this->timein));
        } else {
            $pc_id = "'" . $this->pc_id . "'";
            $pc_number = "'" . $this->pc_number . "'";
            $date = "'" . $this->date . "'";
            $srcodeid = "'" . $this->srcodeid . "'";
            $timein = "'" . $this->timein . "'";
        }

        $sqlQuery = "UPDATE clms_pc SET status = 'available', user_srcode = NULL, date = NULL, time = NULL, session_code = NULL WHERE id IN ($pc_id) AND laboratory_id = ? AND status != 'not available'";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->lab_id]);
        $stmt->closeCursor();

        $timeouttime = $this->timeOut;

        if ($stmt) {
            $timeoutsql = "UPDATE `clms_logs` SET `timeout`= '$timeouttime' WHERE pc_number IN ($pc_number)  AND srcode IN ($srcodeid) AND date IN ($date) AND timein IN ($timein) AND laboratory_id = ?";
            $stmt = $this->conn->prepare($timeoutsql);
            $stmt->execute([$this->lab_id]);
            if ($stmt) {
                return "Success";
            } else {
                return "Failed";
            }
        }
    }

    public function addRecordTimeInLogs($mdb)
    {
        $pdo  = $mdb;

        $checkSRCODEExist = "SELECT * FROM malvar_db.mdb_student_info WHERE SRCODE = ?";
        $check = $pdo->prepare($checkSRCODEExist);
        $check->execute([$this->srcodeid]);
        $returnResult = array();
        if ($check->rowCount() > 0) {
            array_push($returnResult, array("message" => "Existing"));
            return $returnResult;
        } else {
            $addRecord_sql = "INSERT INTO malvar_db.mdb_student_info (`SRCODE`, `FULLNAME`, `GENDER`, `DEPARTMENT_CODE`, `COURSE_CODE`, `BIRTHDATE`, `PRESENT_ADDRESS`, `STATUS`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = $pdo->prepare($addRecord_sql);
            $stmt->execute([$this->srcodeid, $this->fullname, $this->gender, $this->department, $this->course, $this->birthdate, $this->address, 'ENROLLED']);
            if ($stmt) {
                $sqlQuery = "UPDATE clms_pc SET status = 'occupied', user_srcode = ?, date = ?, time = ?, session_code = ? WHERE id = ? AND laboratory_id = ?";
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->execute(array($this->srcodeid, $this->date, $this->timein, $this->sessionCode, $this->pc_id, $this->lab_id));
                $rowCount = $stmt->rowCount();
                $stmt->closeCursor();

                if ($rowCount > 0) {
                    $insertsql = "INSERT INTO `clms_logs`( `srcode`, `fullname`, `session_code`, `laboratory_id`, `laboratory_name`, `timein`, `date`, `faculty_name`, `subject`, `section`, `pc_number`, `department`, `course`, `purpose`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $this->conn->prepare($insertsql);
                    $stmt->execute(array($this->srcodeid, $this->fullname, $this->sessionCode, $this->lab_id, $this->lab_name, $this->timein, $this->date, $this->facultyName, $this->subject, $this->section, $this->pc_number, $this->department, $this->course, $this->purpose));
                    $stmt->closeCursor();
                    if ($stmt) {
                        array_push($returnResult, array("message" => "Success"));
                        return $returnResult;
                    } else {
                        array_push($returnResult, array("message" => "Failed"));
                        return $returnResult;
                    }
                } else {
                    array_push($returnResult, array("message" => "Failed"));
                    return $returnResult;
                }
            } else {
                array_push($returnResult, array("message" => "Add Failed"));
                return $returnResult;
            }
        }
    }

    public function reportsLogs(){
        $reportsLogs = "SELECT * FROM `clms_logs` WHERE `date` BETWEEN ? AND ? AND laboratory_id = ?";
        $stmt = $this->conn->prepare($reportsLogs);
        $stmt->execute([$this->startdate, $this->enddate, $this->lab_id]);
        if($stmt){
            $fetchData["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fetchData;
        }else{
            return "Failed";
        }
    }

    
    public function deleteLog()
    {
        $sql = "DELETE FROM `clms_logs` WHERE id = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->log_id]);
        $stmt->closeCursor();

        if ($stmt) {
            return "Success";
        } else {
            return "Failed";
        }
    }

    public function attendeesLogs(){
        $attendeeslogs = "SELECT * FROM `clms_logs` WHERE session_code = ?";
        $stmt = $this->conn->prepare($attendeeslogs);
        $stmt->execute([$this->sessionCode]);
        if($stmt){
            $fetchData["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fetchData;
        }else{
            return "Failed";
        }
    }
}
