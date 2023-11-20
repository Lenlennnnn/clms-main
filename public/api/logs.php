<?php
declare (strict_types = 1);
session_start();

include('../../src/config/dbconfig.php');
include('../../src/class/logs.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$requestType = $_SERVER["REQUEST_METHOD"];

switch ($requestType) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        if (isset($data->mode)) {
            $mode = $data->mode;
        } else {
            $mode = $_POST['mode'];
        }
        switch($mode){
            case "timein_logs":
                $database = new Database();
                $db = $database->dbConnection();
                $timein = new Logs($db);
                $timein->srcodeid = $data->studentCode;
                $timein->fullname = $data->fullname;
                $timein->sessionCode = $data->sessionCode;
                $timein->lab_id = $data->lab_id;
                $timein->lab_name = $data->labName;
                $timein->timein = $data->timeIn;
                $timein->date = $data->date;
                $timein->facultyName = $data->faculty_name;
                $timein->subject = $data->subject;
                $timein->section = $data->section;
                $timein->pc_number = $data->computernumber;
                $timein->department = $data->department;
                $timein->course = $data->course;
                $timein->purpose = $data->purpose;
                $timein->pc_id = $data->computerId;

                if($res = $timein->timeInLogs()){
                    echo json_encode($res);
                }
            break;

            case "addRecord_timein_logs":
                $database = new Database();
                $db = $database->dbConnection();

                $mdb = $database->malvarDbConnection();

                $timein = new Logs($db);
                $timein->srcodeid = $data->srcode;
                $timein->fullname = $data->fullname;
                $timein->sessionCode = $data->sessionCode;
                $timein->lab_id = $data->lab_id;
                $timein->lab_name = $data->labName;
                $timein->timein = $data->timeIn;
                $timein->date = $data->date;
                $timein->facultyName = $data->faculty_name;
                $timein->subject = $data->subject;
                $timein->section = $data->section;
                $timein->pc_number = $data->computernumber;
                $timein->department = $data->department;
                $timein->course = $data->course;
                $timein->purpose = $data->purpose;
                $timein->pc_id = $data->computerId;
                $timein->gender = $data->gender;
                $timein->birthdate = $data->birthdate;
                $timein->address = $data->address;

                if($res = $timein->addRecordTimeInLogs($mdb)){
                    echo json_encode($res);
                }
            break;

            case "timeout_logs":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new Logs($db);
                $item->pc_id = $data->pc_id;
                $item->pc_number = $data->pc_number;
                $item->date = $data->date;
                $item->timein = $data->time;
                $item->timeOut = $data->timeOut;
                $item->srcodeid = $data->srcode;
                $item->lab_id =  $data->lab_id;
                
                if($res = $item->timeOutLogs()){
                    echo json_encode($res);
                }
            break;
            
            case "reports_logs":
                $database = new Database();
                $db = $database->dbConnection();
                $reportlogs = new Logs($db);
                $reportlogs->startdate = $data->startdate;
                $reportlogs->enddate = $data->enddate;
                $reportlogs->lab_id = $data->lab_id;

                if($res = $reportlogs->reportsLogs()){
                    echo json_encode($res);
                }
            break;

            case "delete_log":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new Logs($db);
                $item->log_id = $data->log_id;
                if ($res = $item->deleteLog()) {
                    echo $res;
                }
                break;

                case "attendees_logs":
                    $database = new Database();
                    $db = $database->dbConnection();
                    $reportlogs = new Logs($db);
                    $reportlogs->sessionCode = $data->sessionCode;
    
                    if($res = $reportlogs->attendeesLogs()){
                        echo json_encode($res);
                    }
                break;
        }
        
        
        break;
}
?>