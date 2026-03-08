<?php
session_start();
include "includes/db.php";

if(isset($_POST['register'])){

$business = $_POST['business_name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (business_name,email,password)
VALUES ('$business','$email','$password')";

if($conn->query($sql) === TRUE){

header("Location: login.php");
exit();

}else{
$error = "Registration failed";
}

}
?>

<?php include "includes/header.php"; ?>

<section class="register-container">

<h2>Create Account</h2>

<?php if(isset($error)){ ?>
<p style="color:red;"><?php echo $error; ?></p>
<?php } ?>

<form method="POST">

<input type="text" name="business_name" placeholder="Business Name" required>

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="register">Register</button>

</form>

</section>

<?php include "includes/footer.php"; ?>