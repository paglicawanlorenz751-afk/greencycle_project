<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">



<link rel="stylesheet" href="/greencycle/CSS/style.css?v=8">

</head>

<body>

<div class="page-wrapper">

<nav class="navbar">

<div class="nav-container">

<div class="logo-area">
<img src="/image/logo.png" class="logo-img">

</div>

<div class="menu">

<a href="index.php">Home</a>
<a href="materials.php">Materials</a>

<?php if(isset($_SESSION['user_id'])){ ?>

<a href="dashboard.php">Dashboard</a>
<a href="post_material.php">Post Material</a>
<a class="logout-btn" href="logout.php">Logout</a>

<?php } else { ?>

<a href="login.php">Login</a>
<a class="register-btn" href="register.php">Register</a>

<?php } ?>

</div>

</div>

</nav>

<main class="content">