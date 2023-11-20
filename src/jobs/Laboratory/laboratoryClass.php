<?php

class LaboratoryJob {

    private $conn;
    public function __construct($db){
        $this->conn = $db;
    }
    public function defaultLaboratoryStatus() {
        $sql = "UPDATE `clms_laboratories` SET `laboratory_status`= ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['Inactive']);
    }
}