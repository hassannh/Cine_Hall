<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../database/Database.php';
include_once '../../models/user.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog user object
$user = new user($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $user->name = $data->username;
  $user->email = $data->email;
  $user->password = $data->password;
    // Create post
    if($user->register()) {
        echo json_encode(
          array('message' => 'account Created',
                'resulte' => $user->token
                )
        );
      } else {
        echo json_encode(
          array('message' => 'account Not Created')
        );
      }
?>