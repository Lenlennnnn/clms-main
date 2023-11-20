<?php

class LogsJobs {

    private $conn;
    public function __construct($db){
        $this->conn = $db;
    }
    public function timeOutAllActiveLogs($current_time) {
        $sql = "UPDATE `clms_logs` SET `timeout`= ? WHERE `timeout` IS NULL;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$current_time]);
    }
}