<?php

// Getting whatever is submited
$data = json_decode(file_get_contents("php://input"));

// Set name and password of a student that I want to create
$student->name = $data->name;
$student->grade = $data->grade;

// Create student
if($student->create())
{
    echo json_encode(array('message' => 'Student created!'));
}
else{
    echo json_encode(array('message' => 'Student not created!'));
}

?>