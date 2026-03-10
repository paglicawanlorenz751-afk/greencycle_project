<?php
session_start();
include "includes/db.php";

$id = $_GET['id'];

/* approve request */
$conn->query("UPDATE requests SET status='approved' WHERE id='$id'");

/* get material id */
$result = $conn->query("SELECT material_id FROM requests WHERE id='$id'");
$row = $result->fetch_assoc();

$material_id = $row['material_id'];

/* mark material sold */
$conn->query("UPDATE materials SET status='sold' WHERE id='$material_id'");

header("Location: dashboard.php");
?>