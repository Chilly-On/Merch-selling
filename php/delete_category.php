<?php
include 'config/load_db.php';
$id = $_POST['id'];
mysqli_query($conn, "DELETE FROM category WHERE id = $id");
?>
