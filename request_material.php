<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$material_id = $_GET['id'];
$requester = $_SESSION['user_id'];

$sql = "INSERT INTO requests (material_id, requester_id)
VALUES ('$material_id','$requester')";

$conn->query($sql);

header("Location: materials.php");
exit();
?>