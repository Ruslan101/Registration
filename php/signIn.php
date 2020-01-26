<?php 
// Basic headers
header("Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cche");
header("Content-Type: application/json; charset=utf-8");

// If no data is transmitted
if($_POST["email"] == null || $_POST["password"] == null) {
        header("HTTP/1.1 400 Bad Request");

        echo json_encode( [ "State" => false, 'Error message' => "Expected data. But transmitted null. You need to pass the necessary parameters to call this method" ]);
        exit();
}

// Const for database connect
$host = "localhost";
$user = "root";
$password = "";

// Open database connection
$db = @mysqli_connect($host, $user, $password);
$result = mysqli_query($db, 'SELECT * FROM market.users');
$row = mysqli_fetch_assoc($result);

if($result) {
        while(mysqli_fetch_assoc($result)) {
                if($_POST["email"] == $row["Login"] && $_POST["password"] == $row["Password"]) {
                        header("HTTP/1.1 200 OK");
                        echo json_encode([ "State" => true, "Message" => "You are logged in" ]);
                        exit();
                }
        }
        header("HTTP/1.1 400 Bad Request");
        echo json_encode([ "State" => false, "Message" => "No user with this data found"]);
        exit();
}


?>