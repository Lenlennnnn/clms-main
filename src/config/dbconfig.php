<?php
class Database
{
    public $conn;
    public $mdbconn;

    //DEVELOPMENT CREDENT
    private $servername = "localhost";
    private $username = 'root';
    private $password = "";

    // LIVE CREDENTIALS
    // private $servername = "192.168.200.0";
    // private $username = "ictservices";
    // private $password = "ict7786633";

    private $dbname = 'computerlaboratorymanagementsystem';
    public function dbConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname . "", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            //echo 'Connection error: '.$exception->getMessage();
            echo 'Database connection Error. Please contact I.T.';
        }
        return $this->conn;
    }


    public function malvarDbConnection()
    {
        $this->mdbconn = null;

        try {
            $this->mdbconn = new PDO("mysql:host=" . $this->servername . "", $this->username, $this->password);
            $this->mdbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            //echo 'Connection error: '.$exception->getMessage();
            echo 'Database connection Error. Please contact I.T.';
        }
        return $this->mdbconn;
    }
}