<?php
session_start();
include "includes/db.php";
include "includes/header.php";

/* SEARCH */
$search = "";

if(isset($_GET['search'])){
$search = $_GET['search'];
}

/* MATERIAL QUERY */
$sql = "SELECT * FROM materials 
WHERE material_name LIKE '%$search%' 
ORDER BY created_at DESC";

$result = $conn->query($sql);
?>

<section class="materials">

<h2>Available Materials</h2>

<form class="search-bar" method="GET">

<input type="text" name="search" placeholder="Search materials..." value="<?php echo $search; ?>">

<button type="submit">Search</button>

</form>

<div class="materials-grid">

<?php while($row = $result->fetch_assoc()){ ?>

<div class="material-card">

<img src="uploads/<?php echo $row['image']; ?>" class="material-img">

<span class="category-tag"><?php echo $row['category']; ?></span>

<h3><?php echo $row['material_name']; ?></h3>

<p><?php echo $row['description']; ?></p>

<p><strong>Quantity:</strong> <?php echo $row['quantity']; ?></p>

<p><strong>Location:</strong> <?php echo $row['location']; ?></p>

<?php if($row['status'] != 'sold'){ ?>

    <?php if(isset($_SESSION['user_id']) && $row['user_id'] != $_SESSION['user_id']){ ?>

        <a href="buy_material.php?id=<?php echo $row['id']; ?>" class="btn">
        Buy Material
        </a>

    <?php } else { ?>

        <p style="color:gray;">Your Post</p>

    <?php } ?>

<?php } else { ?>

<p style="color:red;font-weight:bold;">SOLD</p>

<?php } ?>

</div>

<?php } ?>

</div>

</section>

<?php include "includes/footer.php"; ?>