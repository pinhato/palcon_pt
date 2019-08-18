<?php

// Getting whatever is submited
$data = json_decode(file_get_contents("php://input"));

// Set name of student that i want to update hes grade
$student->name = $data->name;
$student->grade = $data->grade;

// Update student
if($student->update())
{
    echo json_encode(array('message' => 'Student updated!'));
}
else{
    echo json_encode(array('message' => 'Student not updated!'));
}

?>