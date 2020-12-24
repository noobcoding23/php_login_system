<?php
$server = "localhost";
$username = "jugal";
$password = "Sorbhog@2017";
$database = "users";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
//     echo "Successfully connected";
// } else {
    die("Error" . mysqli_connect_error());
}

?>