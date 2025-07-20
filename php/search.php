<?php
    include '../config.php';

    if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
    }
    $lang = $_SESSION['lang'] ?? 'en';

    include "lang.php";
    $currentLang = $_SESSION['lang'] ?? 'en';
    $t = $lang_strings[$currentLang];
    global $t;


    if (isset($_POST['query'])) {
        $search = mysqli_real_escape_string($conn, $_POST['query']);
        $sql = "SELECT product.*, category.name AS category_name
                FROM product
                JOIN category ON product.category_id = category.id
                WHERE product.name LIKE '%$search%' OR category.name LIKE '%$search%'
                ";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                    <a href='index.php?page=product_desc&id={$row['id']}'>
                        <div class='result-item'>
                            <h4>{$row['name']}</h4>
                            <p>{$t['category']}: {$row['category_name']}</p>
                            <p style='color:green;'>{$row['price']} yen</p>
                        </div>
                    </a>";
            } 
        } else {
            echo '<p>No results found.</p>';
        }
    }
?>
