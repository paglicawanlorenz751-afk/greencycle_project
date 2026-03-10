<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

/* CHECK IF ID EXISTS */
if(!isset($_GET['id'])){
    header("Location: dashboard.php");
    exit();
}

$request_id = intval($_GET['id']);

/* =========================
   GET MATERIAL ID FROM REQUEST
========================= */

$result = $conn->query("SELECT material_id FROM requests WHERE id='$request_id'");

if(!$result || $result->num_rows == 0){
    header("Location: dashboard.php");
    exit();
}

$row = $result->fetch_assoc();
$material_id = $row['material_id'];


/* =========================
   APPROVE THE REQUEST
========================= */

$conn->query("UPDATE requests 
              SET status='approved' 
              WHERE id='$request_id'");


/* =========================
   MARK MATERIAL AS SOLD
========================= */

$conn->query("UPDATE materials 
              SET quantity='0' 
              WHERE id='$material_id'");


/* =========================
   CANCEL OTHER REQUESTS
========================= */

$conn->query("UPDATE requests 
              SET status='rejected' 
              WHERE material_id='$material_id' 
              AND id!='$request_id'");


/* =========================
   REDIRECT BACK TO DASHBOARD
========================= */

header("Location: dashboard.php");
exit();

?>