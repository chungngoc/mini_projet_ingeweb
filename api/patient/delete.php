<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/patient.php';

// get connection with database
$database = new Database();
$db = $database->getConnection();
 
// prepare patient object
$patient = new Patient($db);
 
// set id of patient
$patient->id = $_POST['id'];
 
// remove patient
if($patient->delete()){
    $patient_arr=array(
        "status" => true,
        "message" => "Removed Successfully!"
    );
}
else{
    $patient_arr=array(
        "status" => false,
        "message" => "Patient Cannot be deleted!"
    );
}
print_r(json_encode($patient_arr));
?>