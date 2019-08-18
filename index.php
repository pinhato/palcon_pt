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

    //it was not sent
    if(isset($_SERVER['HTTP_REFERER'])) {
        echo "Nothing sent!";
    }
    //it was sent
    else
    {   
        //The URL will be sent 
        //Explain: www.example.com/file_name.php/action_to_do 
        
        //Parsing the url make a $uri_segments array 
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        //Make a $uri_segments array which explode by '/' 
        $uri_segments = explode('/', $uri_path);

        // Get the available actions from the 'actions' directory
        $available_actions = scandir('./actions');

        // Create the require action filename. The action is the last (forth index) part of the url
        $action = $uri_segments[3] . '.php';

        // Check whether the action exist in the actions directory
        if(in_array($action, $available_actions)) {

            // Include our Databse and Student Classes
            include_once 'config/Database.php';
            include_once 'models/Students.php';
            
            //Instatiate DB and connect
            $database = new Database();
            $db = $database->connect();
            
            //Instatiate students object
            $students = new Students($db);
            
            // Execute required function
            include_once "actions/$action";

            
        } else {
            // Return Error
            echo "INVALID method!";
        }
    }
?>