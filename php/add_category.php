<?php
include 'config/load_db.php';
$name = $_POST['name'];
mysqli_query($conn, "INSERT INTO category (name) VALUES ('$name')");
?>
