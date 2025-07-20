<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <?php include "sub_element/header.php"; ?>
    <h1 class="upper-main" style="background-color: #d6c9f2">
        <?php echo $t["contact"]; ?>
    </h1>
    <main class="outer-main">
        <div class="inner-main">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <section class="mb-4 text-center">
                    <h2 class="mb-4 text-center"><?php echo $t["creator"]; ?></h2>
                    <img src="public/image/avatar.jpg" alt="Logo" width="100" height="100">
                </section>
                <section class="mb-5">
                    <h2 class="mb-4 text-center"><?php echo $t["about_page"]; ?></h2>
                    <p><?php echo $t["about_this_page"]; ?></p>
                    <p><?php echo $t["about_this_page2"]; ?></p>
                </section>

                <section class="mb-5">
                    <h2 class="mb-4 text-center"><?php echo $t["contact_information"]; ?></h2>
                    <ul class="list-group">
                        <li class="list-group-item"><img src="public/image/x.jpg" width="20" height="20" alt="X"> <?php echo $t["x_account"]; ?></li>
                        <li class="list-group-item"><img src="public/image/fb.png" width="20" height="20" alt="Facebook"> <?php echo $t["facebook"]; ?></li>
                        <li class="list-group-item"><img src="public/image/yt.png" width="20" height="20" alt="YouTube"> <?php echo $t["youtube"]; ?></li>
                        <li class="list-group-item"><img src="public/image/github.png" width="20" height="20" alt="GitHub"> <?php echo $t["github"]; ?></li>
                        <li class="list-group-item"><img src="public/image/mail.png" width="20" height="20" alt="Email"> <?php echo $t["email"]; ?></li>
                        <li class="list-group-item"><img src="public/image/phone.png" width="20" height="20" alt="Phone"> <?php echo $t["phone"]; ?></li>
                    </ul>
                </section>

                <section class="mb-5">
                    <h2 class="mb-4 text-center"><?php echo $t["contact_form"]; ?></h2>

                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <form class="form-contact" action="#" method="POST" id="form">
                                <div class="mb-3">
                                    <label for="name" class="form-label"><?php echo $t["name_label"]; ?></label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label"><?php echo $t["email_label"]; ?></label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="message" class="form-label"><?php echo $t["message_label"]; ?></label>
                                    <textarea class="form-control" name="message" rows="3" required></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary w-100"><?php echo $t["submit_button"]; ?></button>
                            </form>
                        </div>
                    </div>
                </section>

            </div>

            <!-- Store Map -->
            <div class="col-md-10">
                <h2 class="text-center mb-3"><?php echo $t["store_locations"]; ?></h2>
                <div id="map" class="store-map" style="height: 400px; width: 100%;"></div>
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


    <script src="public/js/map.js"></script>



</body>
</html>