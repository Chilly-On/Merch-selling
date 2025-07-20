<?php

    include "config/load_db.php";
    $charset = 'utf8';
$dsn = "mysql:host=$db_server;dbname=$db_name;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
    $stmt = $pdo->query('SELECT name, address FROM stores');
    $stores = $stmt->fetchAll();
    echo json_encode($stores);
} catch (\PDOException $e) {
    echo json_encode([]);
}
?>
