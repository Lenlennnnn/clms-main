<?php

declare(strict_types=1);
session_start();

include('../../src/config/dbconfig.php');
include('../../src/class/pc-items.php');

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

        switch ($mode) {
            case "display_pc":
                $database = new Database();
                $db = $database->dbConnection();
                $displaypc = new PC($db);
                $displaypc->lab_id = $data->lab_id;

                if ($res = $displaypc->fetchPCItems()) {
                    echo json_encode($res);
                }
                break;

            case "count_pc":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new PC($db);
                $item->lab_id = $data->lab_id;

                if ($res = $item->fetchTotalItems()) {
                    echo json_encode($res);
                }
                break;

            case "add_pc":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new PC($db);
                $item->pcnumber = $data->pcnumber;
                $item->pcIPaddress = $data->pcIPaddress;
                $item->lab_id = $data->lab_id;

                if ($res = $item->addPC()) {
                    echo $res;
                }
                break;
            case "edit_pc":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new PC($db);
                $item->pcnum = $data->pcnum;
                $item->ipaddress = $data->ipaddress;
                $item->pcid = $data->pcid;

                if ($res = $item->editPC()) {
                    echo $res;
                }
                break;
            case "display_list":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new PC($db);

                $item->lab_id = $data->lab_id;

                if ($res = $item->listPC()) {
                    echo json_encode($res);
                }
                break;

            case "delete_pc":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new PC($db);
                $item->pc_id = $data->pc_id;
                $item->lab_id = $data->lab_id;

                if ($res = $item->deletePC()) {
                    echo $res;
                }
                break;

            case "get_comp_info":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new PC($db);
                $item->ip_address = $data->ipaddress;

                if ($res = $item->getCompInfo()) {
                    echo json_encode($res);
                }
                break;

            case "report_problem":
                $database = new Database();
                $db = $database->dbConnection();
                $reportProblem = new PC($db);
                $reportProblem->labName = $data->labName;
                $reportProblem->lab_id = $data->lab_id;
                $reportProblem->pc_id = $data->reportPCID;
                $reportProblem->pc_number = $data->reportPCNumber;
                $reportProblem->reportStatement = $data->reportStatement;
                $reportProblem->reportedBy = $data->reportedBy;
                $reportProblem->reportedDate = $data->reportedDate;


                if ($res = $reportProblem->reportProblem()) {
                    echo json_encode($res);
                }
                break;
        }


        break;
}