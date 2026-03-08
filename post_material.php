<?php
session_start();
include "includes/db.php";
include "includes/header.php";

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

if(isset($_POST['submit'])){

$name = $_POST['name'];
$desc = $_POST['description'];
$qty = $_POST['quantity'];
$loc = $_POST['location'];
$category = $_POST['category'];

$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

move_uploaded_file($tmp,"uploads/".$image);

$user_id = $_SESSION['user_id'];

$sql = "INSERT INTO materials 
(user_id,material_name,description,quantity,location,image,category)
VALUES 
('$user_id','$name','$desc','$qty','$loc','$image','$category')";

$conn->query($sql);

echo "<p style='text-align:center;color:green;'>Material posted successfully!</p>";

}
?>

<section class="post-material">

<h2>Post Material</h2>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="name" placeholder="Material Name" required>

<textarea name="description" placeholder="Description"></textarea>

<input type="text" name="quantity" placeholder="Quantity">

<input type="text" name="location" placeholder="Location">

<select name="category" required>

<option value="">Select Category</option>
<option value="Plastic">Plastic</option>
<option value="Metal">Metal</option>
<option value="Paper">Paper</option>
<option value="Glass">Glass</option>
<option value="Electronics">Electronics</option>
<option value="Organic">Organic</option>

</select>

<input type="file" name="image" required>

<button type="submit" name="submit">Post Material</button>

</form>

</section>

<?php include "includes/footer.php"; ?>