<?php
session_start();
include "includes/db.php";
include "includes/header.php";

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$user_id = $_SESSION['user_id'];

/* USER MATERIALS */
$sql = "SELECT * FROM materials WHERE user_id='$user_id'";
$result = $conn->query($sql);
?>

<section class="dashboard">

<h2>Welcome, <?php echo $_SESSION['business_name']; ?></h2>

<a href="post_material.php" class="btn">Post New Material</a>

<h3>Your Materials</h3>

<div class="materials-grid">

<?php while($material = $result->fetch_assoc()){ ?>

<div class="material-card">

<img src="uploads/<?php echo $material['image']; ?>" class="material-img">

<h3><?php echo $material['material_name']; ?></h3><br>

<p><?php echo $material['description']; ?></p><br>

<p><?php echo $material['quantity']; ?></p><br>

<p><?php echo $material['location']; ?></p><br>

</div>

<?php } ?>

</div>


<h3 style="margin-top:40px;">Material Requests</h3>

<?php

$sql = "SELECT requests.*, materials.material_name
FROM requests
JOIN materials ON requests.material_id = materials.id
WHERE materials.user_id = '$user_id'";

$requests = $conn->query($sql);

while($request = $requests->fetch_assoc()){
?>

<div class="request-card">

<p><strong>Material:</strong> <?php echo $request['material_name']; ?></p>

<p>Status: <?php echo $request['status']; ?></p>

</div>

<?php } ?>

</section>

<?php include "includes/footer.php"; ?>