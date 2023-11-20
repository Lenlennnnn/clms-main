<?php

declare(strict_types=1);

include('../../src/config/dbconfig.php');
include('../../src/class/users.php');

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
            case "search_user":
                $database = new Database();
                $db = $database->dbConnection();
                $mdb = $database->malvarDbConnection();
                $item = new Users($db);
                $item->srcodeid = $data->srcodeid;

                if ($result = $item->searchUser($mdb)) {
                    echo json_encode($result);
                }
                break;

            case "user_list":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new Users($db);


                if ($res = $item->userList()) {
                    echo json_encode($res);
                } else {
                    echo "No users found";
                }
                break;

            case "add_user":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new Users($db);
                $item->fullname = $data->fullname;
                $item->username = $data->username;
                $item->role = $data->role;
                $item->password = password_hash($data->username, PASSWORD_DEFAULT);


                if ($res = $item->addUser()) {
                    echo json_encode($res);
                }
                break;

            case "delete_user":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new Users($db);
                $item->userid = $data->userid;
                if ($res = $item->deleteUser()) {
                    echo $res;
                }
                break;

            case "default_password":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new Users($db);

                $item->defaultpassword = $data->defaultpassword;
                $item->userid = $data->currentuser;

                if ($result = $item->defaultPass()) {
                    echo json_encode($result);
                }

                break;

            case "edit_user":
                $database = new Database();
                $db = $database->dbConnection();
                $item = new Users($db);
                $item->fullname = $data->fullname;
                $item->username = $data->username;
                $item->role = $data->role;
                $item->userid = $data->userid;

                if ($res = $item->editUser()) {
                    echo json_encode($res);
                }
                break;
            case "fetchDeptCourse":
                $database = new Database();
                $db = $database->dbConnection();
                $mdb = $database->malvarDbConnection();
                $item = new Users($db);

                if ($result = $item->fetchDeptCourse($mdb)) {
                    echo json_encode($result);
                }
                break;
        }


        break;
}