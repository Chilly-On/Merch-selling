<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

include 'config/load_db.php';

if (!$conn) {
    echo json_encode([
        "success" => false,
        "message" => "Database connection failed."
    ]);
    exit;
}

// Collect product data from POST
$id = isset($_POST['id']) ? intval($_POST['id']) : null;
$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? '';
$image = $_POST['image'] ?? '';
$category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
$brand_id = $_POST['brand_id'] ?? null;



if (empty($name) || empty($price)) {
    echo json_encode([
        "success" => false,
        "message" => "Name and price are required."
    ]);
    exit;
}

if ($id) {
    // UPDATE product
    $sql = "UPDATE product SET name=?, description=?, price=?, image=?, category_id=?, brand_id=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssdsiii", $name, $description, $price, $image, $category_id, $brand_id, $id);
    $action = "updated";
} else {
    // INSERT new product
    $sql = "INSERT INTO product (name, description, price, image, category_id, brand_id) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssdsii", $name, $description, $price, $image, $category_id, $brand_id);
    $action = "added";
}

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "success" => true,
        "message" => "Product $action successfully!"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . mysqli_error($conn)
    ]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
