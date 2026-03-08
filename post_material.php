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

if(isset($_POST['submit'])){

$name = $_POST['name'];
$desc = $_POST['description'];
$qty = $_POST['quantity'];
$loc = $_POST['location'];

$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

move_uploaded_file($tmp,"uploads/".$image);

$user_id = $_SESSION['user_id'];

$sql = "INSERT INTO materials (user_id,material_name,description,quantity,location,image)
VALUES ('$user_id','$name','$desc','$qty','$loc','$image')";

$conn->query($sql);

echo "<p>Material posted successfully!</p>";

}
?>

<section class="post-material">

<h2>Post Material</h2>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="name" placeholder="Material Name" required>

<textarea name="description" placeholder="Description"></textarea>

<input type="text" name="quantity" placeholder="Quantity">

<input type="text" name="location" placeholder="Location">

<input type="file" name="image" required>

<button type="submit" name="submit">Post Material</button>

</form>

</section>

<?php include "includes/footer.php"; ?>