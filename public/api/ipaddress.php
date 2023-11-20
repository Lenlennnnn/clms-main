<?php
declare(strict_types=1);

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
            case "get_ip_address":
                $ipaddress = '';
                if (isset($_SERVER['HTTP_CLIENT_IP'])){
                    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                }else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }else if(isset($_SERVER['REMOTE_ADDR']))
                    $ipaddress = $_SERVER['REMOTE_ADDR'];
                    // $ipaddress = "192.168.201.93";
                else{
                    $ipaddress = 'UNKNOWN';
                }
                   
                echo $ipaddress;
                break;
        }


        break;
}