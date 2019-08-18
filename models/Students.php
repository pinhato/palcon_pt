<?php

class Students{
    //DB connection
    private $conn;
    private $table = 'students';

    //Properties
    public $name;
    public $grade;

    //DB with constructor
    public function __construct($db){
        $this->conn = $db;
    }

    //Get students
    public function read(){

        //Create a select query
        $query = 'SELECT name, grade
                FROM ' . $this->table;

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute the query
        $stmt->execute();

        return $stmt;
    }

    //Create new student
    public function create(){

        //Create query
        $query = 'INSERT INTO ' . $this->table 
                . ' SET name = :name, grade = :grade';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data for security
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->grade = htmlspecialchars(strip_tags($this->grade));

        //Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':grade', $this->grade);

        //Execute query
        if($stmt->execute()){
            return true;
        }
        else{
            //Print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);
            return false;
        }

    }

    //Update student
    public function update(){

        //Create query
        $query = 'UPDATE ' . $this->table . 
                ' SET grade = :grade
                WHERE name = :name';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data for security
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->grade = htmlspecialchars(strip_tags($this->grade));

        //Bind data
        $stmt->bindParam(':grade', $this->grade);
        $stmt->bindParam(':name', $this->name);
        
        //Execute query
        if($stmt->execute()){
            return true;
        }
        else{
            //Print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);
            return false;
        }
    }

    //Delete student
    public function delete(){

        //Create query
        $query = 'DELETE FROM ' . $this->table . 
                ' WHERE name = :name';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data for security
        $this->name = htmlspecialchars(strip_tags($this->name));
        
        //Bind data
        $stmt->bindParam(':name', $this->name);

        //Execute query
        if($stmt->execute()){
            return true;
        }
        else{
            //Print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);
            return false;
        }
    }
}
?>