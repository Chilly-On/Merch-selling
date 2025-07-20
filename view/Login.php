<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?= $t['login'] ?></title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php include "sub_element/header.php"; ?>
    <h1 class="upper-main" style="background-color: #5297b3">
        <?= $t['login'] ?>
    </h1>
    <main class="outer-main">
        <div class="inner-main">
            <div class="row justify-content-center">
            <div class="col-md-6">

                <!-- Message Section -->
                <?php if (empty($_GET['attempt'])): ?>
                    <div class="text-center mb-4">
                        <h2><?= $t['login_message'] ?></h2>
                    </div>
                <?php else: ?>
                    <div class="text-center mb-4 text-danger">
                        <h2><?= $t['login_error'] ?></h2>
                    </div>
                <?php endif; ?>

                <!-- Login Form -->
                <div class="card shadow">
                    <div class="card-body">
                        <form action="php/login.php" method="POST" id="form">
                            <div class="mb-3">
                                <label for="email" class="form-label"><?= $t['email'] ?>:</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label"><?= $t['password'] ?>:</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>

                            <button type="submit" class="btn btn-info w-100"><?= $t['submit'] ?></button>
                        </form>
                    </div>
                </div>

                <!-- Sign Up Link -->
                <div class="text-center mt-4">
                    <h5><?= $t['new_here'] ?></h5>
                    <a href="index.php?page=signUp" class="btn btn-outline-secondary mt-2"><?= $t['signup_here'] ?></a>
                </div>

                <div class="text-center mt-4">
                    <a href="#" class="btn btn-outline-secondary mt-2"><?= $t['forgot_password'] ?></a>
                </div>

            </div>
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
