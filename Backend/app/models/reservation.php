<?php

class reservation
{

    public $id;
    public $id_user;
    public $hall_name;
    public $place_number;
    public $booking_date;
    public $price;

    public $conn;


    public function __construct($database)
    {
        $this->conn = $database;
    }

    public function add_reservation()
    {

        $query = 'INSERT INTO booking ( id_user, hall_name,place_number,booking_date,price)VALUES (:id_user, :hall_name,:place_number,:booking_date,:price)';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Bind values
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':hall_name', $this->hall_name);
        $stmt->bindParam(':place_number', $this->place_number);
        $stmt->bindParam(':booking_date', $this->booking_date);
        $stmt->bindParam(':price', $this->price);

        $this->booked();

        // Execute query
        if ($stmt->execute()) {
            echo '<pre>';
            var_dump($stmt);
            echo '</pre>';
            exit;
            return true;
        }

        // Print error if something goes wrong
        echo 'can\'t add reservation!';

        return false;
    }


    public function getOne($id)
    {
        $query = 'SELECT * FROM booking Where id=' .$id;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return  $stmt->fetch(PDO::FETCH_OBJ);
    }




    public function booked()
    {
        $query = 'SELECT * FROM hall_' . $this->hall_name . ' WHERE place_number = :place_number ';
        // Prepare statement 

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':place_number', $this->place_number);
        $stmt->execute();
        $place_info = $stmt->fetch();


        $place_id = (int)$place_info['id_place'];



        $query2 = 'UPDATE hall_' .  $this->hall_name . ' SET book = 1 WHERE id_place = :id_place';


        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bindParam(':id_place', $place_id);
        echo '<pre>';

        if ($stmt2->execute()) {
            return true;
        }

        // Print error if something goes wrong
        echo 'reservation not found';

        return false;
    }


    public function get_reservationByUserID($id)
    {
        $query = "SELECT m.*,b.id as res_id ,b.* FROM booking b, movies m WHERE  b.hall_name = m.hall_number  and id_user = " . $id;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    public function deleteRes($id, $num_hall, $num_place)
    {
        $query = 'UPDATE hall_' . $num_hall . '
        SET  book = 0
        WHERE id_place = ' . $num_place;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $query = 'DELETE  FROM booking WHERE id = ' . $id;
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }


    public function delete_reservation()
    {
        // select reservation by id
        $query = 'SELECT * FROM booking WHERE id = ' . $this->id;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        // fetch info for reservation
        $booking_info = $stmt->fetch();
        // put info name hall and number place in varibales
        $hall_name = $booking_info->hall_name;
        $place_number = $booking_info->place_number;

        // delete reservation by id
        $query2 = 'DELETE  FROM booking WHERE id = ' . $this->id;
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->execute();

        // select row from $hall_name where place number = $place_number
        $query3 = 'SELECT * FROM ' . $hall_name . ' WHERE place_number = :place_number ';
        $stmt3 = $this->conn->prepare($query3);
        $stmt3->bindParam(':place_number', $place_number);
        $stmt3->execute();
        // fetch info place
        $place_info = $stmt3->fetch();
        // put info id_place in varibale
        $place_id = $place_info->id_place;

        $query4 = 'UPDATE ' .  $hall_name . 'SET book = 0 WHERE id_place = :id_place';

        $stmt4 = $this->conn->prepare($query4);
        $stmt4->bindParam(':id_place', $place_id);
        if ($stmt4->execute()) {
            return true;
        }

        // Print error if something goes wrong
        echo 'reservation not found';

        return false;
    }
}
