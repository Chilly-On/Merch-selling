﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
initial-scale=1.0">
    <title><?= $t['homepage'] ?></title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php include "sub_element/header.php"; ?>
    <!--
    
    <h1 class="upper-main">         <!-- Replace by slideshow here
        Home
    </h1>
    -->
    <main class="outer-main">
        <div>
            <div class="slider">
                <div class="slider-inner" id="slider-inner">
                    <img src="public/image/banner/nanahira0banner.png" alt="Slide Image">
                    <img src="public/image/banner/nor0banner.png" alt="Slide Image">
                    <img src="public/image/banner/yuce0banner.png" alt="Slide Image">
                </div>
                <button class="arrow arrow-left btn btn-outline-light">&#x3C;</button>
                <button class="arrow arrow-right btn btn-outline-light">&#x3E;</button>
            </div>
            <div class="dots" id="dots"></div>
        </div>
        <div class="inner-main">
        <h2 class="homepage-section-title"><?= $t['feature_product']?></h2>
            <div class="product-grid">
                <?php
                $sql = "SELECT product.*, brand.name AS brand_name, brand.image AS brand_image
                        FROM product
                        JOIN brand ON product.brand_id = brand.id
                        LIMIT 6";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="product-card">';

                    // Product detail link
                    echo '<a href="index.php?page=product_desc&id=' . $row['id'] . '" class="text-decoration-none text-dark">';
                    echo '<img src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                    echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                    echo '</a>';

                    // Brand link
                    echo '<a href="index.php?page=product&brand_id=' . $row['brand_id'] . '" class="text-decoration-none d-inline-flex align-items-center brand-home">';
                    echo '<img src="' . htmlspecialchars($row['brand_image']) . '" alt="' . htmlspecialchars($row['brand_name']) . ' logo" height="50" width="50">';
                    echo '<strong class="ms-2">' . htmlspecialchars($row['brand_name']) . '</strong>';
                    echo '</a>';

                    echo '<h4>' . htmlspecialchars($row['price']) . ' yen</h4>';
                    echo '</div>';
                }
                ?>
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

    <script>
    const images = [
        "public/image/banner/nanahira0banner.png",
        "public/image/banner/nor0banner.png",
        "public/image/banner/yuce0banner.png"
    ];

    let currentIndex = 0;
    const slider = document.querySelector('.slider');
    const sliderInner = document.getElementById('slider-inner');
    const imageElements = sliderInner.querySelectorAll('img');
    const dotsContainer = document.getElementById('dots');

    // Dynamically set widths
    function setImageWidths() {
        const sliderWidth = 711;
        imageElements.forEach(img => {
            img.style.width = `${sliderWidth}px`;
        });
        sliderInner.style.width = `${sliderWidth * images.length}px`;
        updateSliderPosition();
    }

    // Move slider and update dots
    function updateSliderPosition() {
        const sliderWidth = slider.offsetWidth;
        sliderInner.style.transform = `translateX(-${currentIndex * sliderWidth}px)`;
        updateActiveDot();
    }

    // Create dot indicators
    function createDots() {
        for (let i = 0; i < images.length; i++) {
            const dot = document.createElement('span');
            dot.classList.add('dot');
            dot.dataset.index = i;
            dotsContainer.appendChild(dot);

            dot.addEventListener('click', () => {
                currentIndex = i;
                updateSliderPosition();
            });
        }
        updateActiveDot();
    }

    // Set active dot
    function updateActiveDot() {
        document.querySelectorAll('.dot').forEach(dot => {
            dot.classList.remove('active');
        });
        document.querySelectorAll('.dot')[currentIndex].classList.add('active');
    }

    // Buttons
    document.querySelector('.arrow-left').addEventListener('click', () => {
        currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
        updateSliderPosition();
    });

    document.querySelector('.arrow-right').addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateSliderPosition();
    });

    window.addEventListener('resize', setImageWidths);
    window.addEventListener('load', () => {
        createDots();
        setImageWidths();
    });
    </script>



</body>
</html>