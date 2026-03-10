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

<div class="dashboard-container">

<h2>Welcome, <?php echo $_SESSION['business_name']; ?></h2>

<a href="post_material.php" class="btn">Post New Material</a>

<div class="dashboard-section">

<h3>Your Materials</h3>

<div class="materials-grid">

<?php if($result->num_rows == 0){ ?>

<p>No materials posted yet.</p>

<?php } ?>

<?php while($material = $result->fetch_assoc()){ ?>

<div class="material-card">

<img src="uploads/<?php echo !empty($material['image']) ? $material['image'] : 'default.png'; ?>" class="material-img">

<div class="material-info">

<h3><?php echo $material['material_name']; ?></h3>

<p><?php echo $material['description']; ?></p>

<p><strong>Quantity:</strong> <?php echo $material['quantity']; ?></p>

<p><strong>Location:</strong> <?php echo $material['location']; ?></p>

</div>

</div>

<?php } ?>

</div>

</div>

<div class="dashboard-section">

<h3>Material Requests</h3>

<?php
while($request = $requests->fetch_assoc()){
?>

<div class="request-card">

<p><strong>Material:</strong> <?php echo $request['material_name']; ?></p>
<p><strong>Buyer:</strong> <?php echo $request['buyer_id']; ?></p>
<p><strong>Payment:</strong> <?php echo $request['payment_method']; ?></p>

<p>Status: <?php echo $request['status']; ?></p>

<?php if($request['status'] == 'pending'){ ?>

<a href="approve_request.php?id=<?php echo $request['id']; ?>" class="btn">
Approve
</a>

<a href="reject_request.php?id=<?php echo $request['id']; ?>" class="btn" style="background:#c62828;">
Reject
</a>

<?php } ?>

</div>

<?php } ?>

</div>

</div>