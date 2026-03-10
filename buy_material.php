<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$material_id = $_GET['id'];
?>

<?php include "includes/header.php"; ?>

<div class="post-form">

<h2>Buy Material</h2>

<form action="submit_buy.php" method="POST">

<input type="hidden" name="material_id" value="<?php echo $material_id; ?>">

<label>Payment Method</label>

<select name="payment_method" required>
<option value="">Select Payment</option>
<option value="cash">Cash on Pickup</option>
<option value="gcash">GCash</option>
</select>

<button type="submit">Confirm Purchase</button>

</form>

</div>

<?php include "includes/footer.php"; ?>