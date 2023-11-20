<?php

class Laboratory{

    private $conn;
    public $lab_id, $labname, $status, $labid;

    public function __construct($db){
        $this->conn = $db;
    }


    public function fetchLabLists(){
        $sql = "SELECT * FROM `clms_laboratories`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $res;
    }

    
    public function addLaboratory()
    {
        $sql = "INSERT INTO `clms_laboratories`(`laboratory_name`, `laboratory_status`) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->labname, 'Inactive']);
        $returnResult = array();
        if ($stmt) {
            array_push($returnResult, array("message" => "Success"));
            return $returnResult;
        } else {
            array_push($returnResult, array("message" => "Failed"));
            return $returnResult;
        }
    }

    
    public function deleteLaboratory()
    {
        $labsql = "DELETE FROM `clms_laboratories` WHERE laboratory_id = ? ";
        $labstmt = $this->conn->prepare($labsql);
        $labstmt->execute([$this->lab_id]);
        $labstmt->closeCursor();

        $pcsql = "DELETE FROM `clms_pc` WHERE laboratory_id = ? ";
        $pcstmt = $this->conn->prepare($pcsql);
        $pcstmt->execute([$this->lab_id]);
        $pcstmt->closeCursor();

        if ($pcstmt  && $labstmt) {
            return "Success";
        } else {
            return "Failed";
        }
    }

    
    public function editLaboratory()
    {
        $sql = "UPDATE `clms_laboratories` SET `laboratory_name` = ?, `laboratory_status` = ? WHERE `laboratory_id` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->labname, $this->status, $this->labid]);
        $returnResult = array();
        if ($stmt) {
            array_push($returnResult, array("message" => "Success"));
            return $returnResult;
        } else {
            array_push($returnResult, array("message" => "Failed"));
            return $returnResult;
        }
    }

    
    public function activeLaboratory()
    {
        $sql = "UPDATE `clms_laboratories` SET `laboratory_status` = ? WHERE `laboratory_id` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['Active', $this->labid]);
        $returnResult = array();
        if ($stmt) {
            array_push($returnResult, array("message" => "Success"));
            return $returnResult;
        } else {
            array_push($returnResult, array("message" => "Failed"));
            return $returnResult;
        }
    }

}