<?php
include('../config/dbconfig.php');
include('Laboratory/laboratoryClass.php');

date_default_timezone_set('Asia/Manila');
$current_time = date('h:i:s A');

$current_Datetime = date('Y-m-d H:i:s');

$database = new Database();
$db = $database->dbConnection();

//------------------------------------------
// Setting the Laboratory Table in default data
//------------------------------------------
$defaultLab = new LaboratoryJob($db);
$defaultLab->defaultLaboratoryStatus();
