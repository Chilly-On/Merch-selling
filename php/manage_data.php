<?php
require 'config/load_db.php';

$type = $_POST['type'] ?? '';
$name = trim($_POST['name'] ?? '');

if ($type && $name !== '') {
    $table = $type === 'category' ? 'category' : 'brand';
    
    // Insert
    if ($_POST['action'] === 'add') {
        $stmt = $conn->prepare("INSERT INTO $table (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $stmt->execute();
    }

    // Delete
    if ($_POST['action'] === 'delete') {
        $stmt = $conn->prepare("DELETE FROM $table WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
    }
}

// Get All
if ($_POST['action'] === 'get') {
    $table = $type === 'category' ? 'category' : 'brand';
    $result = $conn->query("SELECT name FROM $table ORDER BY name ASC");
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row['name'];
    }
    echo json_encode($data);
}
?>
