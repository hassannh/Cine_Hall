<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../database/Database.php';
include_once '../../models/Movie.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog movie object
$movie = new movie($db);
// Get ID
$movie->id = isset($_GET['id']) ? $_GET['id'] : die();

$movie->get_movie();

$movie_arr = array(
    'id' =>$movie-> id,
    'name' =>$movie->name,
    'picture' =>$movie->picture,
    'time' =>$movie->time,
    'place_price' =>$movie->place_price,
    'hall_number' =>$movie->hall_number,
    'description' =>$movie->description
);
print_r(json_encode($movie_arr));
