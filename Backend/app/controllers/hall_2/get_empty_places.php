<?php



session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

        require_once '../../database/Database.php';
        require_once '../../models/halls.php';


        $database = new Database;
        $connect = $database->connect();

        $halls = new halls($connect);

        $result = $halls->get_empty_places('hall_2');

        $num = $result->rowCount();

        if ($num > 0) {
            // movie array
            $halls_arr = array();
            // $movies_arr['data'] = array();
        
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $hall_item = array(
                    'id_place' => $id_place,
                    'place_number' => $place_number,
                    'book' => $book
                );

               
        
                // Push to "data"
                array_push($halls_arr, $hall_item);
            }
        
            // Turn to JSON & output
            echo json_encode($halls_arr);
        } else {
            // No movies
            echo json_encode(
                array('message' => 'No halls Found')
            );
        }








?>