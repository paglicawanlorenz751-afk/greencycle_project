<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>GreenCycle</title>

<link rel="stylesheet" href="/greencycle/CSS/style.css">

</head>

<body>

<nav class="navbar">

<div class="logo">
GreenCycle
</div>

<div class="menu">

<a href="index.php">Home</a>
<a href="materials.php">Materials</a>

<?php if(isset($_SESSION['user_id'])){ ?>

<a href="dashboard.php">Dashboard</a>
<a href="post_material.php">Post Material</a>
<a href="logout.php">Logout</a>

<?php } else { ?>

<a href="login.php">Login</a>
<a href="register.php">Register</a>

<?php } ?>

</div>

</nav>