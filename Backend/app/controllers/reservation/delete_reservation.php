<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: DELETE');
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

  $reservation->id = $data->id;
    // Create post
    if($reservation->delete_reservation()) {
        echo json_encode(
          array('message' => 'Reservation Deleted')
        );
      } else {
        echo json_encode(
          array('message' => 'Reservation Not Deleted')
        );
      }
?>