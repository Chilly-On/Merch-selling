<?php
header('Content-Type: application/json');
require 'config/load_db.php';

$search = $_GET['search'] ?? '';
$page = max(1, intval($_GET['page'] ?? 1));
$limit = intval($_GET['limit'] ?? 5);
$offset = ($page - 1) * $limit;

$searchTerm = "%$search%";
$hasSearch = !empty($search);

$products = [];
$total = 0;

// Select products
if ($hasSearch) {
    $sql = "
        SELECT p.*, c.name AS category_name, b.name AS brand_name
        FROM product p 
        JOIN category c ON p.category_id = c.id
        JOIN brand b ON p.brand_id = b.id
        WHERE p.name LIKE ?
        ORDER BY p.id DESC
        LIMIT ? OFFSET ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $searchTerm, $limit, $offset);
} else {
    $sql = "
        SELECT p.*, c.name AS category_name, b.name AS brand_name
        FROM product p 
        JOIN category c ON p.category_id = c.id
        JOIN brand b ON p.brand_id = b.id
        ORDER BY p.id DESC
        LIMIT ? OFFSET ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $limit, $offset);
}

if (!$stmt->execute()) {
    error_log("Error executing SELECT query: " . $stmt->error);
}
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Count for pagination
if ($hasSearch) {
    $countSql = "SELECT COUNT(*) AS total FROM product WHERE name LIKE ?";
    $countStmt = $conn->prepare($countSql);
    $countStmt->bind_param("s", $searchTerm);
} else {
    $countSql = "SELECT COUNT(*) AS total FROM product";
    $countStmt = $conn->prepare($countSql);
}

if (!$countStmt->execute()) {
    error_log("Error executing COUNT query: " . $countStmt->error);
}
$countResult = $countStmt->get_result();
$total = $countResult->fetch_assoc()['total'] ?? 0;

echo json_encode([
    "products" => $products,
    "total" => $total
]);
?>
