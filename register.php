<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    exit();
}

$my_email = $_POST["r_email"];
$my_name = $_POST["r_name"];
$my_password = $_POST["r_password"];

$my_password = md5($my_password);

$sql = "SELECT * FROM users WHERE email='$my_email'";

if ($result = $conn->query($sql)) {
    $row = $result->fetch_assoc();
    if ($row) {
        echo "<h1>Email Already Exists, Please Login!</h1><br>";
        echo '<a href="login.html">Back</a>';

    } else {
        $sql = "INSERT INTO users (email , name , password) VALUES ('$my_email','$my_name','$my_password')";
        
        if ($conn->query($sql) === TRUE) {
            $str =  "Welcome " . $my_name;
            echo "<h1>$str</h1><br>";
            echo '<a href="login.html">Signout</a>';
        } else {
            echo "<h1>Failed to Register!</h1><br>";
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    echo "<h1>Failed to Register!</h1><br>";
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

?>