<?php
    //it was not sent
    if(!isset($_SERVER['HTTP_REFERER'])) {
        echo "Nothing sent.";
    }
    //it was sent
    else
    {   
        //Parsing the url make a $uri_segments array 
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        //Make a $uri_segments array which explode by '/' 
        $uri_segments = explode('/', $uri_path);

        //The URL will be sent 
        //Explain: www.example.com/file_name.php/action_to_do 
        //action_to_do will always be at the 3rd index of $uri_segment array
        if($uri_segments[3] === 'read'){
            include_once 'actions/read.php';
        }
        if($uri_segments[3] === 'create'){
            include_once 'actions/create.php';
        }
        if($uri_segments[3] === 'delete'){
            include_once 'actions/delete.php';
        }
        if($uri_segments[3] === 'update'){
            include_once 'actions/update.php';
        }
    }
?>
