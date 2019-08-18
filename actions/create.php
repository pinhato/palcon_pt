<?php
//--Headers--
//Be able to get any kind of header
header('Access-Control-Allow-Origin: *');
//Support variables stored by json
header('Content-Type: Application/json');
//Support only a post requests
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

//Set name and password of a student that I want to create
$student->name = $data->name;
$student->grade = $data->grade;

//Create student
if($student->create())
{
    echo json_encode(array('message' => 'Student created!'));
}
else{
    echo json_encode(array('message' => 'Student not created!'));
}

?>