<?php

class PCJobs {

    private $conn;
    public function __construct($db){
        $this->conn = $db;
    }
    public function defaultPCData() {
        $sql = "UPDATE `clms_pc` SET `status`= 'available', `user_srcode` = NULL, `date` = NULL, `time`= NULL, session_code = NULL WHERE `status` = 'occupied'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }
}