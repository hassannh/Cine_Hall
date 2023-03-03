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

$user->token = $data->token;
// get user by token
$result = $user->getUserByToken();

// Get row count
$num = $result->rowCount();

// Check if any user
if ($num > 0) {
    // user array
    $users_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $user_item = array(
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'token' => $token
        );
        $_SESSION['id'] = $user_item['id'];
        $_SESSION['name'] = $user_item['name'];
        $_SESSION['email'] = $user_item['email'];
        $_SESSION['token'] = $user_item['token'];
        if ($_SESSION['id']&&$_SESSION['name']&&$_SESSION['email']&&$_SESSION['token']) {
            echo json_encode(["message" =>"Valide token"]);
        }else{
            echo json_encode(["message" =>"no Valide token"]);
        }

        // Push to "data"
        array_push($users_arr, $user_item);
    }

    // Turn to JSON & output
    echo json_encode($users_arr);
} else {
    // No users
    echo json_encode(
        array('message' => 'No users Found')
    );
}
