<?php

declare(strict_types=1);
class Users
{
    private $conn;
    public $username, $password, $laboratory_id, $laboratory_name;
    public $srcodeid;
    public $fullname, $role;
    public $userid;

    public $newpassword, $currentpassword, $defaultpassword;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function authenticateUser()
    {

        $sql = "SELECT * FROM clms_laboratories WHERE laboratory_id = ?";
        $checkstmt = $this->conn->prepare($sql);
        $checkstmt->execute(array($this->laboratory_id));
        $result = $checkstmt->fetch(PDO::FETCH_ASSOC);

        $checkLabStatus = $result['laboratory_status'];

        //CHECK IF ACCOUNT EXISTS AND ENABLED
        $sqlQuery = "SELECT * 
        FROM clms_user 
        WHERE username = ?;
        ";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute(array($this->username));
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        if ($stmt) {

            if ($res) {
                $passwordhash = $res['password'];

                if (password_verify($this->password, $passwordhash)) {
                    //VALID PASSWORD

                    //START SESSION 
                    session_start();
                    $_SESSION['clms_username'] = $res['username'];
                    $_SESSION['clms_fullname'] = $res['fullname'];
                    $_SESSION['clms_userid'] = $res['user_id'];
                    $_SESSION['clms_userRole'] = $res['user_role'];
                    $_SESSION['clms_lab_id'] = $this->laboratory_id;
                    $_SESSION['clms_lab_name'] = $this->laboratory_name;


                    if ($this->password === $this->username) {
                        $res['result'] = "default pass";
                    } else {
                        if ($_SESSION['clms_userRole'] === "Admin") {
                            $_SESSION['clms_loggedin'] = true;
                            $res['result'] = "admin-login"; // add the new key-value pair to $res
                        } else {
                            if ($checkLabStatus === "Active") {
                                session_destroy();
                                $res['result'] = "occupied"; // add the new key-value pair to $res
                            } else {
                                $updatesql = "UPDATE clms_laboratories SET laboratory_status = 'Active' WHERE laboratory_id = ?";
                                $updatestmt = $this->conn->prepare($updatesql);
                                $updatestmt->execute(array($this->laboratory_id));
                                $_SESSION['clms_loggedin'] = true;
                                $res['result'] = "login"; // add the new key-value pair to $res
                            }
                        }
                    }
                    return $res;
                } else {
                    //INVALID PASSWORD
                    $res = array();
                    $res['result'] = "invalidpass";
                }
            } else {
                $res['result'] = "notexist";
            }
        } else {
            $res['result'] = "failed";
        }

        return $res;
    }

    public function logoutUser()
    {
        $updatesql = "UPDATE clms_laboratories SET laboratory_status = 'Inactive' WHERE laboratory_id = ?";
        $updatestmt = $this->conn->prepare($updatesql);
        $updatestmt->execute(array($this->laboratory_id));

        if ($updatestmt) {
            return "Success";
        } else {
            return "Failed";
        }
    }

    public function searchUser($mdb)
    {

        $pdo = $mdb;

        $sqlQuery = "SELECT * 
        FROM malvar_db.mdb_student_info
        WHERE SRCODE = ?;
        ";
        $stmt = $pdo->prepare($sqlQuery);
        $stmt->execute(array($this->srcodeid));
        if ($stmt->rowCount() != 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            return $res;
        } else {
            return "No Users found!";
        }
    }

    public function userList()
    {
        $query = "SELECT user_id, fullname, username, user_role FROM `clms_user`;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt) {
            $fetchData["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fetchData;
        } else {
            return "Failed";
        }
    }

    public function addUser()
    {
        $sql = "INSERT INTO `clms_user`(`fullname`, `username`, `password`, `user_role`) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->fullname, $this->username, $this->password, $this->role]);
        $returnResult = array();
        if ($stmt) {
            array_push($returnResult, array("message" => "Success"));
            return $returnResult;
        } else {
            array_push($returnResult, array("message" => "Failed"));
            return $returnResult;
        }
    }


    public function deleteUser()
    {
        $sql = "DELETE FROM `clms_user` WHERE user_id = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->userid]);
        $stmt->closeCursor();

        if ($stmt) {
            return "Success";
        } else {
            return "Failed";
        }
    }

    public function updatePass()
    {
        $newpasshash = password_hash($this->newpassword, PASSWORD_DEFAULT);
        //SELECT USER AND CHECK IF THE CURRENT PASS MATCHED
        $sqlcheckcurrentpass = "SELECT * FROM `clms_user` WHERE user_id = ? ";
        $stmt = $this->conn->prepare($sqlcheckcurrentpass);
        $stmt->execute([$this->userid]);
        $fetchData = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $passwordhash = $fetchData['password'];
        $user = $fetchData['username'];
        $currentID = $fetchData['user_id'];
        //CHECK THE PASSWORD
        if (password_verify($this->currentpassword, $passwordhash)) {

            if ($this->newpassword === $user) {
                return "useanotherpass";
            } else {
                $updatepass = "UPDATE `clms_user` SET `password`= ? WHERE user_id = ? ";
                $updatestmt = $this->conn->prepare($updatepass);
                $updatestmt->execute([$newpasshash, $this->userid]);
                $updatestmt->closeCursor();
                if ($updatestmt) {
                    return "Success";
                } else {
                    return "Failed";
                }
            }
        } else {
            return "currentnotmatch";
        }
    }


    public function defaultPass()
    {
        $newpasshash = password_hash($this->defaultpassword, PASSWORD_DEFAULT);
        //SELECT USER AND CHECK IF THE CURRENT PASS MATCHED
        $sqlcheckcurrentpass = "SELECT * FROM `clms_user` WHERE user_id = ? ";
        $stmt = $this->conn->prepare($sqlcheckcurrentpass);
        $stmt->execute([$this->userid]);
        $stmt->closeCursor();

        $updatepass = "UPDATE `clms_user` SET `password`= ? WHERE user_id = ? ";
        $updatestmt = $this->conn->prepare($updatepass);
        $updatestmt->execute([$newpasshash, $this->userid]);
        $updatestmt->closeCursor();
        if ($updatestmt) {
            return "Success";
        } else {
            return "Failed";
        }
    }



    public function editUser()
    {
        $sql = "UPDATE `clms_user` SET `fullname` = ?, `username`= ?, `user_role`= ? WHERE `user_id` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->fullname, $this->username, $this->role, $this->userid]);
        $returnResult = array();
        if ($stmt) {
            array_push($returnResult, array("message" => "Success"));
            return $returnResult;
        } else {
            array_push($returnResult, array("message" => "Failed"));
            return $returnResult;
        }
    }


    public function fetchDeptCourse($mdb)
    {
        $pdo = $mdb;
        $returnResult = array('department' => [], 'course' => []);

        $sqlQuery = "SELECT DEPARTMENT_CODE FROM malvar_db.mdb_student_info GROUP BY DEPARTMENT_CODE;";
        $stmt = $pdo->prepare($sqlQuery);
        $stmt->execute();
        if ($stmt->rowCount() != 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            foreach ($res as $row) { // Fixed the loop
                array_push($returnResult['department'], $row['DEPARTMENT_CODE']); // Fixed the array access
            }
        } else {
            return "No Department found!";
        }


        $sqlQuery = "SELECT COURSE_CODE FROM malvar_db.mdb_student_info GROUP BY COURSE_CODE;";
        $stmt = $pdo->prepare($sqlQuery);
        $stmt->execute();
        if ($stmt->rowCount() != 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            foreach ($res as $row) { // Fixed the loop
                array_push($returnResult['course'], $row['COURSE_CODE']); // Fixed the array access
            }
        } else {
            return "No course found!";
        }

        return $returnResult;
    }

}