<?php
header('Content-Type: application/json');
include 'config/load_db.php';

$result = mysqli_query($conn, "SELECT * FROM category");
$categories = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}
echo json_encode($categories);
?>
