<?php

$host = "localhost";
$user = "u844423440_greencycle_use";
$pass = "9kM?Gu|u";
$db = "u844423440_greencycle_db";

$conn = new mysqli($host,$user,$pass,$db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>