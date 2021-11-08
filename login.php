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

$my_email = $_POST["email"];
$my_password = $_POST["password"];

$my_password = md5($my_password);

$sql = "SELECT * FROM users WHERE email='$my_email' and password='$my_password' ";

if ($result = $conn->query($sql)) {
    $row = $result->fetch_assoc();
    if ($row) {
        $str =  "Welcome " . $row["name"];
        echo "<h1>$str</h1><br>";
        echo '<a href="login.html">Signout</a>';
    } else {
        echo "<h1>Account Does not Exist!</h1><br>";
        echo '<a href="login.html">Back</a>';
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>