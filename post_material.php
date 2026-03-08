<?php
session_start();
include "includes/db.php";
include "includes/header.php";

if(isset($_POST['submit'])){

$name = $_POST['name'];
$desc = $_POST['description'];
$qty = $_POST['quantity'];
$loc = $_POST['location'];

$sql = "INSERT INTO materials (material_name,description,quantity,location)
VALUES ('$name','$desc','$qty','$loc')";

$conn->query($sql);

echo "<p>Material posted successfully!</p>";

}
?>

<section class="post-material">

<h2>Post Material</h2>

<form method="POST">

<input type="text" name="name" placeholder="Material Name" required>

<textarea name="description" placeholder="Description"></textarea>

<input type="text" name="quantity" placeholder="Quantity">

<input type="text" name="location" placeholder="Location">

<button type="submit" name="submit">Post Material</button>

</form>

</section>

<?php include "includes/footer.php"; ?>