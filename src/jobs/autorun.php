<?php
include('../config/dbconfig.php');
include('Laboratory/laboratoryClass.php');
include('Logs/logsClass.php');
include('PC/PCClass.php');
include('Session/SessionClass.php');

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

//------------------------------------------
// Timeout all active logs
//------------------------------------------
$timeOutAll = new LogsJobs($db);
$timeOutAll->timeOutAllActiveLogs($current_time);

//------------------------------------------
// Setting the PC Table in default data
//------------------------------------------
$defaultPC = new PCJobs($db);
$defaultPC->defaultPCData();

//------------------------------------------
// End Session All active
//------------------------------------------
$endSession = new SessionJobs($db);
$endSession->endAllSessionActive($current_Datetime);


