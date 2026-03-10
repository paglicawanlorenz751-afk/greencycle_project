<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: dashboard.php");
    exit();
}

$request_id = intval($_GET['id']);

/* GET MATERIAL ID */
$result = $conn->query("SELECT material_id FROM requests WHERE id='$request_id'");

if(!$result || $result->num_rows == 0){
    header("Location: dashboard.php");
    exit();
}

$row = $result->fetch_assoc();
$material_id = $row['material_id'];

/* APPROVE REQUEST */
$conn->query("UPDATE requests 
              SET status='approved' 
              WHERE id='$request_id'");

/* MARK MATERIAL SOLD */
$conn->query("UPDATE materials 
              SET status='sold' 
              WHERE id='$material_id'");

/* REJECT OTHER REQUESTS */
$conn->query("UPDATE requests 
              SET status='rejected' 
              WHERE material_id='$material_id' 
              AND id!='$request_id'");

header("Location: dashboard.php");
exit();
?>