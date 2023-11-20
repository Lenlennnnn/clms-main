<?php
declare(strict_types=1);

include('../../src/config/dbconfig.php');
include('../../src/class/laboratory.php');

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
            case "fetch_lab_lists":
                $database = new Database();
                $db = $database->dbConnection();
                $lablists = new Laboratory($db);

                if ($res = $lablists->fetchLabLists()) {
                    echo json_encode($res);
                }
                break;

                case "add_lab":
                    $database = new Database();
                    $db = $database->dbConnection();
                    $item = new Laboratory($db);
                    $item->labname = $data->labname;

    
                    if ($res = $item->addLaboratory()) {
                        echo json_encode($res);
                    }
                    break;
    
                case "delete_lab":
                    $database = new Database();
                    $db = $database->dbConnection();
                    $item = new Laboratory($db);
                    $item->lab_id = $data->lab_id;
                    if ($res = $item->deleteLaboratory()) {
                        echo $res;
                    }
                    break;

                    
                case "edit_lab":
                    $database = new Database();
                    $db = $database->dbConnection();
                    $item = new Laboratory($db);
                    $item->labname = $data->labname;
                    $item->status = $data->status;
                    $item->labid = $data->labid;
    
                    if ($res = $item->editLaboratory()) {
                        echo json_encode($res);
                    }
                    break;

                    case "set_active_lab":
                        $database = new Database();
                        $db = $database->dbConnection();
                        $item = new Laboratory($db);
                        $item->labid = $data->labid;
        
                        if ($res = $item->activeLaboratory()) {
                            echo json_encode($res);
                        }
                        break;
        }


        break;
}