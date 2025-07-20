<!DOCTYPE html>
<html lang="<?= $locale ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $t['category'] ?></title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php include "sub_element/header.php"; ?>
    <h1 class="upper-main" style="background-color: #e37f6e">
        <?= $t['categories'] ?>
    </h1>
    <main class="outer-main">
        <div class="inner-main">
            <div class="col-lg-4">
                <section>
                    <h1><?= $t['list_artists'] ?></h1>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" style="gap: 20px;">
                        <?php
                        $brand_sql = "SELECT * FROM brand";
                        $brand_result = mysqli_query($conn, $brand_sql);

                        if ($brand_result && mysqli_num_rows($brand_result) > 0) {
                            while ($brand = mysqli_fetch_assoc($brand_result)) {
                                echo "<div class='col'>";
                                echo "<a href='index.php?page=product&brand_id=" . $brand['id'] . "' class='text-decoration-none'>";
                                echo "<div class='card h-100 shadow-sm text-center'>";
                                echo "<img src='" . htmlspecialchars($brand['image']) . "' class='card-img-top img-fluid' alt='" . htmlspecialchars($brand['name']) . "' style='object-fit: contain; height: 250px;'>";
                                echo "<div class='card-body'>";
                                echo "<h5 class='card-title text-dark'>" . htmlspecialchars($brand['name']) . "</h5>";
                                echo "</div>";
                                echo "</div>";
                                echo "</a>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p>{$t['no_brands']}</p>";
                        }
                        ?>
                    </div>
                </section>

                <section>
                    <h1><?= $t['list_categories'] ?></h1>
                    <ul class="list-group">
                        <?php
                        $category_sql = "SELECT * FROM category";
                        $category_result = mysqli_query($conn, $category_sql);

                        if ($category_result && mysqli_num_rows($category_result) > 0) {
                            while ($category = mysqli_fetch_assoc($category_result)) {
                                echo "<a href='index.php?page=product&category_id=" . $category['id'] . "'>";
                                echo "<li class='list-group-item'>" . htmlspecialchars($category['name']) . "</li>";
                                echo "</a>";
                            }
                        } else {
                            echo "<li class='list-group-item'>{$t['no_categories']}</li>";
                        }
                        ?>
                    </ul>
                </section>
            </div>
        </div>
    </main>

<footer style="display: flex;">
    <div class="left">
        COPYRIGHT &#169; CHILLY ON - <?= $t['rights_reserved'] ?>
    </div>
    <form method="GET" id="lang-form">
        <select name="lang" onchange="document.getElementById('lang-form').submit()" class="form-select w-auto d-inline">
            <option value="en" <?= ($_SESSION['lang'] ?? 'en') === 'en' ? 'selected' : '' ?>>English</option>
            <option value="jp" <?= ($_SESSION['lang'] ?? 'en') === 'jp' ? 'selected' : '' ?>>日本語</option>
            <option value="vi" <?= ($_SESSION['lang'] ?? 'en') === 'vi' ? 'selected' : '' ?>>Tiếng Việt</option>
        </select>
        <input type="hidden" name="page" value="<?= $_GET['page'] ?? 'home' ?>">
    </form>
    <div class="right">
        <nav>
            <ul class="navi-right">
                <?php
                if (isset($_SESSION['role']) && $_SESSION['role'] == "admin"){
                    echo "<li><a href='index.php?page=admin'>{$t['admin']}</a></li>";
                }
                ?>
                <li><a href="index.php?page=product"><?= $t['product'] ?></a></li>
                <li><a href="index.php?page=category"><?= $t['category'] ?></a></li>
                <li><a href="index.php?page=contact"><?= $t['contact'] ?></a></li>
                <?php
                if (isset($_SESSION['email'])){
                    echo "<li><a href='php/logout.php'>{$t['logout']} {$_SESSION['email']}</a></li>";
                } else {
                    echo "<li><a href='index.php?page=signUp'>{$t['login_signup']}</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>
</footer>


<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
