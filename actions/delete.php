<?php

// Getting whatever is submited
$data = json_decode(file_get_contents("php://input"));

// Set name to delete
$student->name = $data->name;

// Delete student
if($student->delete())
{
    echo json_encode(array('message' => 'Student deleted!'));
}
else{
    echo json_encode(array('message' => 'Student not deleted!'));
}

?>