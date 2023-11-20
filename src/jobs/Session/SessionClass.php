<?php

class SessionJobs {

    private $conn;
    public function __construct($db){
        $this->conn = $db;
    }
    public function endAllSessionActive($current_Datetime) {
        $sql = "UPDATE `clms_session` SET `session_status`= 'Expired', `end_date` = ? WHERE `session_status` = 'Active' AND `end_date` IS NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$current_Datetime]);
    }
}