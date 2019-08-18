<?php

// Get the students query
$result = $students->read();

// Get row count to check if there is any students in the db
$num = $result->rowCount();

// There is a students in my db
if ($num > 0){
    $students_arr = array();
    $students_arr['data'] = array();

    // Check each row that comes from the DB
    while( $row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $student_item = array(
            'name' => $name,
            'grade' => $grade
        );

        // Push the data we get from the DB to array
        array_push($students_arr['data'], $student_item);
    }
    echo json_encode($students_arr);
}
// Else there is no students in my db
else{
    echo json_encode(
        array('message' => 'No students found')
    );
}
?>