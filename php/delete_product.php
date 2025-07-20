<?php
include 'config/load_db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM product WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true, "message" => "Product deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Delete failed."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "No ID provided."]);
}
?>
