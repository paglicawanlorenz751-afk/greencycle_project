<?php
include "includes/db.php";
include "includes/header.php";

$sql = "SELECT * FROM materials ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<section class="materials">

<h2>Available Materials</h2>

<div class="materials-grid">

<?php
while($row = $result->fetch_assoc()){
?>

<div class="material-card">
    
    <img src="uploads/<?php echo $row['image']; ?>" class="material-img">

<h3><?php echo $row['material_name']; ?></h3>

<p><?php echo $row['description']; ?></p>

<p><strong>Quantity:</strong> <?php echo $row['quantity']; ?></p>

<p><strong>Location:</strong> <?php echo $row['location']; ?></p>

</div>

<?php } ?>

</div>

</section>

<?php include "includes/footer.php"; ?>