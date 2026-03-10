

<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include "includes/header.php";

$user_id = $_SESSION['user_id'];

/* =========================
   USER MATERIALS (SELLING)
========================= */

$sql = "SELECT * FROM materials 
        WHERE user_id='$user_id' 
        ORDER BY created_at DESC";

$result = $conn->query($sql);

/* =========================
   BUY REQUESTS (SELLER SIDE)
========================= */

$sql2 = "SELECT requests.*, materials.material_name, users.business_name
FROM requests
JOIN materials ON requests.material_id = materials.id
JOIN users ON requests.buyer_id = users.id
WHERE materials.user_id='$user_id'
ORDER BY requests.id DESC";

$requests = $conn->query($sql2);
/* =========================
   PURCHASES (BUYER SIDE)
========================= */

$sql3 = "SELECT requests.*, materials.material_name
FROM requests
JOIN materials ON requests.material_id = materials.id
WHERE requests.buyer_id='$user_id'
ORDER BY requests.id DESC";

$purchases = $conn->query($sql3);
?>

<div class="dashboard-container">

<h2>Welcome, <?php echo $_SESSION['business_name']; ?></h2>

<a href="post_material.php" class="btn">Post New Material</a>


<!-- =========================
     YOUR MATERIALS
========================= -->

<div class="dashboard-section">

<h3>Your Materials</h3>

<div class="materials-grid">

<?php
if($result && $result->num_rows > 0){

    while($material = $result->fetch_assoc()){
?>

<div class="material-card">

<img src="uploads/<?php echo !empty($material['image']) ? $material['image'] : 'default.png'; ?>" class="material-img">

<div class="material-info">

<h3><?php echo $material['material_name']; ?></h3>

<p><?php echo $material['description']; ?></p>

<p><strong>Quantity:</strong> <?php echo $material['quantity']; ?></p>

<p><strong>Location:</strong> <?php echo $material['location']; ?></p>

</div>

</div>

<?php
    }

}else{

echo "<p>No materials posted yet.</p>";

}
?>

</div>

</div>



<!-- =========================
     BUY REQUESTS (SELLER)
========================= -->

<div class="dashboard-section">

<h3>Material Requests</h3>

<?php

if($requests && $requests->num_rows > 0){

while($request = $requests->fetch_assoc()){
?>

<div class="request-card">

<p><strong>Material:</strong> <?php echo $request['material_name']; ?></p>

<p><strong>Buyer:</strong> <?php echo $request['business_name']; ?>

<p><strong>Payment:</strong> <?php echo $request['payment_method']; ?></p>

<p><strong>Status:</strong> <?php echo $request['status']; ?></p>


<?php if($request['status'] == 'pending'){ ?>

<a href="approve_request.php?id=<?php echo $request['id']; ?>" class="btn">
Accept Buyer
</a>

<a href="reject_request.php?id=<?php echo $request['id']; ?>" class="btn" style="background:#c62828;">
Reject
</a>

<?php } ?>


</div>

<?php
}

}else{

echo "<p>No purchase requests yet.</p>";

}
?>

</div>



<!-- =========================
     YOUR PURCHASES (BUYER)
========================= -->

<div class="dashboard-section">

<h3>Your Purchases</h3>

<?php

if($purchases && $purchases->num_rows > 0){

while($purchase = $purchases->fetch_assoc()){
?>

<div class="request-card">

<p><strong>Material:</strong> <?php echo $purchase['material_name']; ?></p>

<p><strong>Payment:</strong> <?php echo $purchase['payment_method']; ?></p>

<p><strong>Status:</strong> <?php echo $purchase['status']; ?></p>

</div>

<?php
}

}else{

echo "<p>You have not purchased any materials yet.</p>";

}
?>

</div>

</div>


<?php include "includes/footer.php"; ?>