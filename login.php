<?php
session_start();
include "includes/db.php";

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if($result->num_rows > 0){

$user = $result->fetch_assoc();

if(password_verify($password,$user['password'])){

$_SESSION['user_id'] = $user['id'];
$_SESSION['business_name'] = $user['business_name'];

header("Location: dashboard.php");
exit();

}else{
$error = "Wrong password";
}

}else{
$error = "User not found";
}

}
?>

<?php include "includes/header.php"; ?>

<section class="login-container">

<h2>Login</h2>

<?php if(isset($error)){ ?>
<p style="color:red;"><?php echo $error; ?></p>
<?php } ?>

<form method="POST">

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>

</form>

</section>

<?php include "includes/footer.php"; ?>