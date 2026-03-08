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
echo "Wrong password";
}

}else{
echo "User not found";
}

}
?>