<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/doctor.php';

// get connection with database
$database = new Database();
$db = $database->getConnection();
 
// prepare doctor object
$doctor = new Doctor($db);
 
// set id of doctor
$doctor->id = $_POST['id'];
 
// remove doctor
if($doctor->delete()){
    $doctor_arr=array(
        "status" => true,
        "message" => "Removed Successfully!"
    );
}
else{
    $doctor_arr=array(
        "status" => false,
        "message" => "Doctor Cannot be deleted. May be he's assigned to a patient!"
    );
}
print_r(json_encode($doctor_arr));
?>