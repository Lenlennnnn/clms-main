<?php

class Problems{

    private $conn;
    public $reportID;
    public $lab_id;
    public $currentDateTime;

    public $startdate, $enddate;
    public $problem_id;
    public function __construct($db){
        $this->conn = $db;
    }


    public function fetchReportProblems(){
        $sql = "SELECT * FROM `clms_problems` WHERE `report_status` = 'PENDING' AND `laboratory_id` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->lab_id]);
        $returnResult = array();
        if($stmt->rowCount() > 0){
            $returnResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            return $returnResult;
        }else{
            array_push($returnResult, array("message" => "No reports found"));
            return $returnResult;
        }
    }

    public function fetchProblemsDetails(){
        $sql = "SELECT * FROM `clms_problems` WHERE id = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->reportID]);
        $returnResult = array();
        if($stmt){
            $returnResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            return $returnResult;
        }else{
            array_push($returnResult, array("message" => "Failed"));
            return $returnResult;
        }
    }

    public function countProblems(){
        $sql = "SELECT 
        pc_counts.laboratory_id, 
        pc_counts.laboratory_name,
        pc_counts.laboratory_status, 
        pc_counts.problem_count, 
        COUNT(pc.id) AS computer_count 
    FROM 
        (SELECT 
            lab.laboratory_id, 
            lab.laboratory_name, 
            lab.laboratory_status, 
            COUNT(prob.laboratory_id) AS problem_count 
         FROM 
            clms_laboratories AS lab 
            LEFT OUTER JOIN clms_problems AS prob 
                ON lab.laboratory_id = prob.laboratory_id 
                AND prob.report_status = 'PENDING'
         GROUP BY 
            lab.laboratory_id, 
            lab.laboratory_name
        ) AS pc_counts 
        LEFT OUTER JOIN clms_pc AS pc 
            ON pc_counts.laboratory_id = pc.laboratory_id
    GROUP BY 
        pc_counts.laboratory_id, 
        pc_counts.laboratory_name, 
        pc_counts.problem_count    
      ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $returnResult = array();
        if($stmt){
            $returnResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            return $returnResult;
        }else{
            array_push($returnResult, array("message" => "Failed"));
            return $returnResult;
        }
    }

    public function fixedPC(){
        $sql = "UPDATE `clms_problems` SET `fixed_date`= ? ,`report_status`= ? WHERE `id` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->currentDateTime, 'FIXED', $this->reportID]);
        $returnResult = array();
        if($stmt){
            $sql = "UPDATE `clms_pc` SET `status`= ? ,`report_id`= ? WHERE `report_id` = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['available', NULL, $this->reportID]);

            if($stmt){
                array_push($returnResult, array("message" => "Success"));
                return $returnResult;
            }else{
                array_push($returnResult, array("message" => "Failed"));
                return $returnResult;
            }
           
        }else{
            array_push($returnResult, array("message" => "Failed"));
            return $returnResult;
        }
    }

    public function reportsProblems(){
        $sql = "SELECT * FROM `clms_problems` WHERE `reported_date` BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->startdate, $this->enddate]);
        if($stmt){
            $fetchData["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fetchData;
        }else{
            return "Failed";
        }
    }

    public function deleteProblem()
    {
        $sql = "DELETE FROM `clms_problems` WHERE id = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->problem_id]);
        $stmt->closeCursor();

        if ($stmt) {
            return "Success";
        } else {
            return "Failed";
        }
    }
}