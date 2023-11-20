<?php

declare(strict_types=1);
class Session
{
    private $conn;

    public $sessionCode, $srcodeid, $date, $timein;

    public $dateTime, $labName, $facultyName, $subject, $purpose, $section, $lab_id, $userID;

    public $endDate;
    public $laboratory_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function checkSessionCode()
    {

        $sql = "SELECT * FROM `clms_session` WHERE session_code = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->sessionCode]);

        if ($stmt->rowCount() === 0) {
            // Account not found
            return "No session code found";
        } else {
            return "Session code existing";
        }
    }


    public function validateSessionCode($mdb)
    {

        $sql = "SELECT * FROM `clms_session` WHERE session_code = ? AND session_status = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->sessionCode, 'Active']);
        $srsessiondata["session"] = array();
        $srsessiondata["srcode"] = array();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            array_push($srsessiondata["session"], $result);


            $pdo  = $mdb;

            $sqlQuery = "SELECT * 
            FROM malvar_db.mdb_student_info
            WHERE SRCODE = ?;
            ";
            $stmt = $pdo->prepare($sqlQuery);
            $stmt->execute(array($this->srcodeid));
            if ($stmt->rowCount() != 0) {
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                array_push($srsessiondata["srcode"], $res);
            } else {
                return "No Users found!";
            }

            return $srsessiondata;
        } else {
            return "No session code found";
        }
    }

    public function addSession()
    {
        $sql = "INSERT INTO `clms_session`(`session_code`, `laboratory_id`, `laboratory_name`, `user_id`, `faculty_name`, `subject`, `section`, `purpose`, `session_date`, `session_status`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->sessionCode, $this->lab_id, $this->labName, $this->userID, $this->facultyName, $this->subject, $this->section, $this->purpose, $this->dateTime, 'Active']);
        if ($stmt) {
            return "Success";
        } else {
            return "Failed";
        }
    }

    public function endSession()
    {
        $sql = "UPDATE `clms_session` SET `session_status` = ? , `end_Date` = ? WHERE `session_code` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['Expired', $this->endDate, $this->sessionCode]);
        if ($stmt) {
            return "Success";
        } else {
            return "Failed";
        }
    }

    public function displayInfo()
    {
        $sql = "SELECT * FROM `clms_logs` AS LOGS INNER JOIN (SELECT * FROM `clms_session` WHERE session_status = 'Active') AS SESSION ON LOGS.session_code = SESSION.session_code WHERE LOGS.srcode = ? AND LOGS.session_code = ? AND LOGS.date = ? AND LOGS.timein = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->srcodeid, $this->sessionCode, $this->date, $this->timein]);

        if ($stmt) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } else {
            return "Failed";
        }
    }

    public function checkExistingSession()
    {

        $sql = "SELECT * FROM `clms_session` WHERE user_id = ? AND laboratory_id = ? AND session_status = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->userID, $this->lab_id, 'Active']);

        if ($stmt->rowCount() > 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } else {
            return "Session code not existing";
        }
    }

    public function fetchSessionPerUser()
    {
        $sql = "SELECT COUNT(LOGS.id) AS num_attendee, SESSION.session_code, SESSION.session_id, SESSION.session_date, SESSION.laboratory_id, SESSION.laboratory_name, SESSION.user_id, SESSION.faculty_name, SESSION.subject, SESSION.section, SESSION.end_date, SESSION.session_status FROM `clms_session` AS SESSION LEFT OUTER JOIN `clms_logs` AS LOGS ON SESSION.session_code = LOGS.session_code WHERE SESSION.user_id = ? GROUP BY SESSION.session_code;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->userID]);

        if ($stmt) {
            $fetchData["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fetchData;
        } else {
            return "Failed";
        }
    }

    public function activeSessionCode()
    {
        $sql = "SELECT * FROM clms_session WHERE session_status = ? AND laboratory_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['Active', $this->laboratory_id]);

        if ($stmt->rowCount() > 0) {
            $fetchData["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fetchData;
        } else {
            return "No session";
        }
    }
}