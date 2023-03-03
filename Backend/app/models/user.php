<?php


class user{

public $conn;

public $id;
public $name;
public $email;
public $password;
public $token;
public $hash_password;


public function __construct($database)
{
    $this->conn = $database;
}


//find user by email
public function getUserByToken()
{
    $query="SELECT * FROM user WHERE token=:token";
    $stmt = $this->conn->prepare($query);
    $stmt->bindparam(':token',$this->token);
    $stmt->execute(); 

    return $stmt;

}


public function register()
{
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->hash_password = password_hash($this->password, PASSWORD_BCRYPT);
    $this->hash_password = htmlspecialchars(strip_tags($this->hash_password));
    $this->token= md5($this->name . $this->password . $this->email);
    $this->token = htmlspecialchars(strip_tags($this->token));

    $test_token = 'SELECT * from user where token = :token2';
    $stmt2 = $this->conn->prepare($test_token);
    $stmt2->bindParam(':token2', $this->token);
    if ($stmt2->execute()) {
        if($stmt2->rowCount()>0)
            return false;
    }
    
    $query = 'INSERT INTO user (name, email, password,token) VALUES (:name, :email, :password,:token)';
    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Clean data

    // Bind values
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':password', $this->hash_password);
    $stmt->bindParam(':token', $this->token);

    // Execute query
    if ($stmt->execute()) {
       return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
}



}