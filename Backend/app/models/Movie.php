<?php

class Movie
{

    public $id;
    public $name;
    public $picture;
    public $time;
    public $place_price;
    public $hall_number;
    public $description;
    
    public $conn;

    public function __construct($database)
    {
        $this->conn = $database;
    }


    public function getmovies(){
        $query = 'SELECT * FROM movies';
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;

    }

    public function get_movie()
    {
        $query = 'SELECT * FROM movies WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(":id",$this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->time = $row['time'];
        $this->place_price = $row['place_price'];
        $this->hall_number = $row['hall_number'];
        $this->picture = $row['picture'];
    }

}








?>