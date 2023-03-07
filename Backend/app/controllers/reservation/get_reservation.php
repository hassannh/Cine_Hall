<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../database/Database.php';
include_once '../../models/reservation.php';


// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog reservation object
$reservation = new reservation($db);

// $reservation->get_reservationByUserID($id);

// Get ID
$id = isset($_GET['id']) ? $_GET['id'] : die();

$result = $reservation->get_reservationByUserID($id);


$num = $result->rowCount();

if ($num > 0) {
    // movie array
    $reservations_arr = [];
    // $movies_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);


        $reservation_item = array(
            'id' => $id,
            'name' => $name,
            'time' => $time,
            'hall_name' => $hall_name,
            'place_number' => $place_number,
            'booking_date' => $booking_date,
            'price' => $price,
            'picture' => $picture
        );



        // Push to "data"
        array_push($reservations_arr, $reservation_item);
    }
    
    // Turn to JSON & output
    echo json_encode($reservations_arr);
} else {
    // No movies
    echo json_encode(
        array('message' => 'No reservations Found')
    );
}

?>


