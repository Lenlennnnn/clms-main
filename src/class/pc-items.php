<?php

class PC
{

    private $conn;
    public $pcnumber, $pcIPaddress;

    public $pc_id;

    public $lab_id;

    public $ip_address;

    public $reportStatement, $reportedBy, $reportedDate, $labName, $pc_number;
    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function fetchPCItems()
    {
        $sql = "SELECT * FROM `clms_pc` AS PC LEFT JOIN (SELECT `SRCODE`, `FULLNAME`, `DEPARTMENT_CODE`, `COURSE_CODE` FROM `malvar_db`.`mdb_student_info`) AS USER ON PC.user_srcode = USER.SRCODE WHERE laboratory_id = ? ORDER BY PC.pc_number ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->lab_id]);
        if ($stmt->rowCount() > 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
        } else {
            $res = "No pc found";
        }

        return $res;
    }


    public function fetchTotalItems()
    {
        $qry = "SELECT 
                    COUNT(*) AS total, 
                    SUM(CASE WHEN status = 'available' THEN 1 ELSE 0 END) AS available,
                    SUM(CASE WHEN status = 'occupied' THEN 1 ELSE 0 END) AS occupied,
                    SUM(CASE WHEN status = 'not available' THEN 1 ELSE 0 END) AS not_available
                FROM `clms_pc` WHERE laboratory_id = ?;";
        $qry_total = $this->conn->prepare($qry);
        $qry_total->execute([$this->lab_id]);
        $res = $qry_total->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function addPC()
    {
        if (is_array($this->pcnumber)) {
            foreach ($this->pcnumber as $key => $value) {
                $pcnumber = "'" . $value . "'";
                $pcIPaddress = "'" . $this->pcIPaddress[$key] . "'";

                $sql_query = "INSERT INTO clms_pc (pc_number, ip_address, status, laboratory_id) VALUES ($pcnumber, $pcIPaddress, 'available', ? )";
                $stmt = $this->conn->prepare($sql_query);
                $stmt->execute([$this->lab_id]);
            }
        } else {
            $pcnumber = "'" . $this->pcnumber . "'";
            $pcIPaddress = "'" . $this->pcIPaddress . "'";
            $sql_query = "INSERT INTO clms_pc (pc_number, ip_address, status, laboratory_id) VALUES ($pcnumber, $pcIPaddress, 'available', ?)";
            $stmt = $this->conn->prepare($sql_query);
            $stmt->execute([$this->lab_id]);
        }

        if ($stmt) {
            return "Success";
        } else {
            return "Failed";
        }
    }

    public function editPC()
    {
        $sql_query = "UPDATE `clms_pc` SET `pc_number`=?, `ip_address`=? WHERE `id` = ?";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute([$this->pcnum, $this->ipaddress, $this->pcid]);
        if ($stmt) {
            return "Success";
        } else {
            return "Failed";
        }
    }


    public function listPC()
    {
        $sql = "SELECT * FROM `clms_pc` WHERE laboratory_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->lab_id]);
        $res["data"] = array();
        if ($stmt->rowCount() > 0) {
            $res["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            return $res;
        } else {
            return $res;
        }
    }

    public function deletePC()
    {
        $sql = "DELETE FROM `clms_pc` WHERE id = ? AND laboratory_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->pc_id, $this->lab_id]);
        $stmt->closeCursor();

        if ($stmt) {
            return "Success";
        } else {
            return "Failed";
        }
    }

    public function getCompInfo()
    {
        $sql = "SELECT * FROM `clms_pc` AS PC INNER JOIN `clms_laboratories` AS LAB ON PC.laboratory_id = LAB.laboratory_id WHERE ip_address = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->ip_address]);

        if ($stmt->rowCount() > 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            return $res;
        } else {
            return "Not registered";
        }
    }

    public function reportProblem()
    {
        $returnResult = array();


        $insert_sql = "INSERT INTO `clms_problems`(`laboratory_id`, `laboratory_name`, `pc_number`, `pc_id`, `report_statement`, `reported_by`, `reported_date`, `report_status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = $this->conn->prepare($insert_sql);
        $insert_stmt->execute([$this->lab_id, $this->labName, $this->pc_number, $this->pc_id, $this->reportStatement, $this->reportedBy, $this->reportedDate, 'PENDING']);

        // Retrieve the ID of the last inserted row
        $inserted_id = $this->conn->lastInsertId();

        if ($insert_stmt) {
            $sql = "UPDATE `clms_pc` SET `status`= ?, report_id = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['not available', $inserted_id, $this->pc_id]);

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
    }
}