<?php
//--Headers--
//Be able to get any kind of header
header('Access-Control-Allow-Origin: *');
//Support variables stored by json
header('Content-Type: Application/json');
//Support only a put requests
header('Access-Control-Allow-Methods: POST');
//Allowed headers
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once 'config/Database.php';
include_once 'models/Students.php';

//Instatiate DB and connect
$database = new Database();
$db = $database->connect();

//Instatiate students object
$student = new Students($db);

//Getting whatever is submited
$data = json_decode(file_get_contents("php://input"));

//Set name of student that i want to update hes grade
$student->name = $data->name;
$student->grade = $data->grade;

//Update student
if($student->update())
{
    echo json_encode(array('message' => 'Student updated!'));
}
else{
    echo json_encode(array('message' => 'Student not updated!'));
}

?>