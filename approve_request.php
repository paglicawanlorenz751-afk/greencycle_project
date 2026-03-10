<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$request_id = $_GET['id'];

/* Get material ID from request */
$result = $conn->query("SELECT material_id FROM requests WHERE id='$request_id'");
$row = $result->fetch_assoc();

$material_id = $row['material_id'];

/* Approve the request */
$conn->query("UPDATE requests SET status='approved' WHERE id='$request_id'");

/* Mark the material as SOLD */
$conn->query("UPDATE materials SET status='sold' WHERE id='$material_id'");

/* Cancel other pending requests */
$conn->query("UPDATE requests 
              SET status='rejected' 
              WHERE material_id='$material_id' AND id!='$request_id'");

header("Location: dashboard.php");
exit();
?>