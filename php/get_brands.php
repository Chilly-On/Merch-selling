<?php
header('Content-Type: application/json');
include 'config/load_db.php';
$result = mysqli_query($conn, "SELECT * FROM brand");
$brands = [];
while ($row = mysqli_fetch_assoc($result)) {
    $brands[] = $row;
}
echo json_encode($brands);
?>
