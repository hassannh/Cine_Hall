<?php
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE, OPTIONS');

if (strtolower($_SERVER['REQUEST_METHOD']) == 'options') {
  http_response_code(200);
  return;
}

include_once '../../database/Database.php';
include_once '../../models/reservation.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog reservation object
$reservation = new reservation($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$single = $reservation->getOne($data->id);
// Create post
if ($reservation->deleteRes($data->id,$single->hall_name,$single->place_number)) {
  echo json_encode(
    array('message' => 'Reservation Deleted')
  );
} else {
  echo json_encode(
    array('message' => 'Reservation Not Deleted')
  );
}
