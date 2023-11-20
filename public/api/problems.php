<?php

declare(strict_types=1);

include('../../src/config/dbconfig.php');
include('../../src/class/problems.php');

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
            case "fetch_problems":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new Problems($db);
                $item->lab_id = $data->lab_id;

                if ($res = $item->fetchReportProblems()) {
                    echo json_encode($res);
                }
                break;

            case "fetch_problems_details":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new Problems($db);
                $item->reportID = $data->reportID;

                if ($res = $item->fetchProblemsDetails()) {
                    echo json_encode($res);
                }
                break;

            case "count_problems":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new Problems($db);

                if ($res = $item->countProblems()) {
                    echo json_encode($res);
                }
                break;
            
            case "fixed_pc":
                $database = new Database();
                $db = $database->dbConnection();
                $fixedpc = new Problems($db);
                $fixedpc->reportID = $data->reportID;
                $fixedpc->currentDateTime = $data->currentDateTime;

                if ($res = $fixedpc->fixedPC()) {
                    echo json_encode($res);
                }
                break;

                case "report_problems":
                    $database = new Database();
                    $db = $database->dbConnection();
                    $problems = new Problems($db);
                    $problems->startdate = $data->startdate;
                    $problems->enddate = $data->enddate;
    
                    if($res = $problems->reportsProblems()){
                        echo json_encode($res);
                    }
                break;

                case "delete_problem":
                    $database = new Database();
                    $db = $database->dbConnection();
                    $item = new Problems($db);
                    $item->problem_id = $data->problem_id;
                    if ($res = $item->deleteProblem()) {
                        echo $res;
                    }
                    break;
        }


        break;
}
