
<?php

session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

        require_once '../../database/Database.php';
        require_once '../../models/Movie.php';


        $database = new Database;
        $connect = $database->connect();

        $data = json_decode(file_get_contents("php://input"));

        $movies = new Movie($connect);

        $result = $movies->getmoviesByDate($data->date);

        $num = $result->rowCount();

        if ($num > 0) {
            // movie array
            $movies_arr = array();
            // $movies_arr['data'] = array();
        
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $movie_item = array(
                    'id' => $id,
                    'name' => $name,
                    'picture' => $picture,
                    'time' => $time,
                    'place_price' => $place_price,
                    'hall_number' => $hall_number,
                    'description' => $description,
                    'date'=> $date
                );

               
        
                // Push to "data"
                array_push($movies_arr, $movie_item);
            }
        
            // Turn to JSON & output
            echo json_encode($movies_arr);
        } else {
            // No movies
            echo json_encode(
                array()
            );
        }








?>