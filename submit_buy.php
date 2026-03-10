<?php
session_start();
include "includes/db.php";


if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

/* CHECK IF FORM WAS SUBMITTED */
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['material_id']) && isset($_POST['payment_method'])){

        $buyer_id = $_SESSION['user_id'];
        $material_id = $_POST['material_id'];
        $payment = $_POST['payment_method'];

        $sql = "INSERT INTO requests (material_id, buyer_id, payment_method, status)
                VALUES ('$material_id','$buyer_id','$payment','pending')";

        if($conn->query($sql) === TRUE){

            header("Location: materials.php");
            exit();

        }else{
            echo "SQL ERROR: " . $conn->error;
        }

    }else{
        echo "Missing form data.";
    }

}else{
    echo "Invalid request.";
}
?>