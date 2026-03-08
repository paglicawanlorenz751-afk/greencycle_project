<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}
?>

<?php
session_start();
include "includes/db.php";
include "includes/header.php";

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM materials WHERE user_id='$user_id'";
$result = $conn->query($sql);
?>

<section class="dashboard">

<h2>Welcome, <?php echo $_SESSION['business_name']; ?></h2>

<a href="post_material.php" class="btn">Post New Material</a>

<h3>Your Materials</h3>

<div class="materials-grid">

<?php while($row = $result->fetch_assoc()){ ?>

<div class="material-card">

<img src="uploads/<?php echo $row['image']; ?>" class="material-img">

<h3><?php echo $row['material_name']; ?></h3>

<p><?php echo $row['description']; ?></p>

<p><?php echo $row['quantity']; ?></p>

<p><?php echo $row['location']; ?></p>

</div>

<h3>Material Requests</h3>

<?php

$sql = "SELECT requests.*, materials.material_name
FROM requests
JOIN materials ON requests.material_id = materials.id
WHERE materials.user_id = '$user_id'";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
?>

<div class="request-card">

<p><strong>Material:</strong> <?php echo $row['material_name']; ?></p>

<p>Status: <?php echo $row['status']; ?></p>

</div>

<?php } ?>

<?php } ?>

</div>

</section>

<?php include "includes/footer.php"; ?>