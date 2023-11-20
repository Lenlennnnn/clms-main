<?php

declare(strict_types=1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once dirname(__DIR__, 2) . '\src\config\dbconfig.php';
include_once dirname(__DIR__, 2) . '\src\class\users.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];
switch ($requestMethod) {
    case 'POST':

        $data = json_decode(file_get_contents('php://input'));

        if (isset($data->mode)) {
            $mode = $data->mode;
        } else {
            $mode = $_POST['mode'];
        }

        switch ($mode) {
            case "authenticate":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new Users($db);
                $item->username = $data->username;
                $item->password = $data->password;
                $item->laboratory_id = $data->laboratory_id;
                $item->laboratory_name = $data->laboratory_name;

                if ($result = $item->authenticateUser()) {
                    echo json_encode($result);
                }
                break;

            case "logout_user":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new Users($db);

                $item->laboratory_id = $data->laboratory_id;

                if ($result = $item->logoutUser()) {
                    echo json_encode($result);
                }
                break;

            case "updatepass":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new Users($db);
                
                $item->currentpassword = $data->currentpassword;
                $item->userid = $data->currentuser;
                $item->newpassword = $data->newpassword;

                if ($result = $item->updatePass()) {
                    echo json_encode($result);
                }

                break;
        }


        break;
}
