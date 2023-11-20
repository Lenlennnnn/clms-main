<?php

declare(strict_types=1);
session_start();

include('../../src/config/dbconfig.php');
include('../../src/class/session.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$requestType = $_SERVER["REQUEST_METHOD"];

switch ($requestType) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        $mode = $data->mode;
        switch ($mode) {
            case "check_sessionCode":
                $database = new Database();
                $db = $database->dbConnection();
                $checkSessionCode = new Session($db);
                $checkSessionCode->sessionCode = $data->sessionCode;

                if ($res = $checkSessionCode->checkSessionCode()) {
                    echo $res;
                }
                break;

            case "validate_session_code":
                $database = new Database();
                $db = $database->dbConnection();

                $mdb = $database->malvarDbConnection();

                $checkSessionCode = new Session($db);
                $checkSessionCode->sessionCode = $data->sessionCode;
                $checkSessionCode->srcodeid = $data->srcode;

                if ($res = $checkSessionCode->validateSessionCode($mdb)) {
                    echo json_encode($res);
                }
                break;

            case "add_session":
                $database = new Database();
                $db = $database->dbConnection();
                $addSession = new Session($db);
                $addSession->sessionCode = $data->sessionCode;
                $addSession->dateTime = $data->dateTime;
                $addSession->labName = $data->labName;
                $addSession->facultyName = $data->facultyName;
                $addSession->subject = $data->subject;
                $addSession->purpose = $data->purpose;
                $addSession->section = $data->section;
                $addSession->lab_id = $data->labID;
                $addSession->userID = $data->userID;

                if ($res = $addSession->addSession()) {
                    echo $res;
                }
                break;

            case "end_session":
                $database = new Database();
                $db = $database->dbConnection();
                $endsession = new Session($db);
                $endsession->sessionCode = $data->sessionCode;
                $endsession->endDate = $data->enddate;

                if ($res = $endsession->endSession()) {
                    echo $res;
                }
                break;

            case "display_info":
                $database = new Database();
                $db = $database->dbConnection();
                $displayinfo = new Session($db);
                $displayinfo->sessionCode = $data->sessionCode;
                $displayinfo->srcodeid = $data->srcode;
                $displayinfo->date = $data->date;
                $displayinfo->timein = $data->timein;

                if ($res = $displayinfo->displayInfo()) {
                    echo json_encode($res);
                }
                break;

            case "check_existing_session":
                $database = new Database();
                $db = $database->dbConnection();
                $displayinfo = new Session($db);
                $displayinfo->lab_id = $data->lab_id;
                $displayinfo->userID = $data->userID;


                if ($res = $displayinfo->checkExistingSession()) {
                    echo json_encode($res);
                }
                break;

            case "fetch_session_per_user":
                $database = new Database();
                $db = $database->dbConnection();
                $displayinfo = new Session($db);
                $displayinfo->userID = $data->userID;


                if ($res = $displayinfo->fetchSessionPerUser()) {
                    echo json_encode($res);
                }
                break;

            case "active_session":
                $database = new Database();
                $db = $database->dbConnection();
                $showsession = new Session($db);
                $showsession->laboratory_id = $data->lab_id;


                if ($res = $showsession->activeSessionCode()) {
                    echo json_encode($res);
                }
                break;
        }


        break;
}