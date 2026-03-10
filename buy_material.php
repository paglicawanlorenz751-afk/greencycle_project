<?php
session_start();
include "includes/db.php";
include "includes/header.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: materials.php");
    exit();
}

$material_id = intval($_GET['id']);

/* GET MATERIAL INFO */
$sql = "SELECT * FROM materials WHERE id='$material_id'";
$result = $conn->query($sql);

if(!$result || $result->num_rows == 0){
    echo "Material not found.";
    exit();
}

$material = $result->fetch_assoc();
?>

<div class="buy-container">

<h2>Buy Material</h2>

<div class="material-preview">

<h3><?php echo $material['material_name']; ?></h3>

<p><?php echo $material['description']; ?></p>

<p><strong>Quantity:</strong> <?php echo $material['quantity']; ?></p>

<p><strong>Location:</strong> <?php echo $material['location']; ?></p>

</div>

<form method="POST" action="submit_buy.php">

<input type="hidden" name="material_id" value="<?php echo $material['id']; ?>">

<label>Payment Method</label>

<select name="payment_method" required>

<option value="gcash">GCash</option>
<option value="cash">Cash</option>

</select>

<br><br>

<button type="submit" class="btn">Confirm Purchase</button>

</form>

</div>

<?php include "includes/footer.php"; ?>