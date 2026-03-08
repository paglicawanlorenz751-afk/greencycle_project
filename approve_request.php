<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$id = $_GET['id'];

$sql = "UPDATE requests SET status='approved' WHERE id='$id'";
$conn->query($sql);

header("Location: dashboard.php");
?>