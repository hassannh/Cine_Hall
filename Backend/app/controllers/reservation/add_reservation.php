<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../database/Database.php';
include_once '../../models/reservation.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog reservation object
$reservation = new reservation($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  if($_SERVER['REQUEST_METHOD'] = 'POST'){


  $reservation->id_user = $data->id_user;
  $reservation->hall_name = $data->hall_name;
  $reservation->place_number = $data->place_number;
  $reservation->booking_date = $data->booking_date;
  $reservation->price = $data->price;
    // Create post
    if($reservation->add_reservation()) {
        echo json_encode(
          array('message' => 'Reservation Created')
        );
      } else {
        echo json_encode(
          array('message' => 'Reservation Not Created')
        );
      }
    }else{
        echo json_encode('there is an issus');
    }
?>