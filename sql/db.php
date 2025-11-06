<?php
$host = "localhost";
$user = "213572";
$password = "G96XnfMp7rci9UAA";
$database = "213572";

$conn = new mysqli($host, $user, $password, $database);

if($conn->connect_error){
    die("Yhteys epäonnistui: " . $conn->connect_error);
}
?>