<?php
// Basic headers
header("Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cche");
header("Content-Type: application/json; charset=utf-8");

// If no data is transmitted
if ($_POST["name"] == "" || $_POST["secondName"] == null || $_POST["email"] == null || $_POST["password"] == null) {
    header("HTTP/1.1 400 Bad Request");

    echo json_encode( [ 'Error message' => "Expected data. But transmitted null. You need to pass the necessary parameters to call this method" ]);
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

if ($result) {
    while (mysqli_fetch_assoc($result)) {
        if($_POST["email"] == $row["Login"]) {
            header("HTTP/1.1 422 Unprocessable Entity");
            
            echo json_encode( [ 'Error message' => "A user with such data (email) is already registered." ]);
            exit();
        }
        else if($_POST["phone"] == $row["phone"] && $_POST["phone"] != null) {
            header("HTTP/1.1 422 Unprocessable Entity");
            
            echo json_encode( [ 'Error message' => "A user with such data (phone number) is already registered." ]);
            exit();
        }
    }

    if(mysqli_multi_query($db, "INSERT INTO market.users VALUES (null, \""
        . $_POST["name"]
        . "\", \"" . $_POST["email"]
        . "\", \"" . $_POST["password"]
        . "\", \"" . $_POST["phone"] . "\")")) {
        header("HTTP/1.1 200 OK");
        echo json_encode([ "Message" => "Data recorded successfully" ]);
    }
    else
        header("HTTP/1.1 500 Internal Server Error");
    
    mysqli_free_result($result);
    exit();
}
else
    header("HTTP/1.1 500 Internal Server Error");
?>