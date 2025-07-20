<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
<header style="display: flex;">
    <div class="logo">
        <a href="index.php">
            <img src="public/image/logo.png" alt="Logo" width="100" height="100">
        </a>
        <?= $t['m3_store'] ?>
    </div>

    <div class="search-wrapper">
        <input type="text" id="search" placeholder="<?= $t['search_placeholder'] ?>" />
        <div id="results"></div>
    </div>

    <nav id="nav-menu">
        <ul>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "admin"): ?>
                <li><a href="index.php?page=admin" class="btn"><?= $t['admin'] ?></a></li>
            <?php endif; ?>
            <li><a href="index.php?page=product" class="btn"><?= $t['product'] ?></a></li>
            <li><a href="index.php?page=category" class="btn"><?= $t['category'] ?></a></li>
            <li><a href="index.php?page=contact" class="btn"><?= $t['contact'] ?></a></li>

            <?php if (isset($_SESSION['email'])): ?>
                <li><a href="php/logout.php" class="btn"><?= $t['logout'] ?></a></li>
            <?php else: ?>
                <li><a href="index.php?page=login" class="btn"><?= $t['login_signup'] ?></a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Mobile Menu 
    <nav>
        <ul>
            <?php
            if (isset($_SESSION['role']) && $_SESSION['role'] == "admin"){
                echo "<li><span><a href='index.php?page=admin'><button href='#' class='btn'>{$t['admin']}</button></a></span></li>";
            }
            ?>
			<li><span><a href="index.php?page=product">
				<button href="#" class="btn"><?= $t['product'] ?></button>
			</a></span></li>
			<li><span><a href="index.php?page=category">
				<button href="#" class="btn"><?= $t['category'] ?></button>
			</a></span></li>
			<li><span><a href="index.php?page=contact">
				<button href="#" class="btn"><?= $t['contact'] ?></button>
			</a></span></li>

			
            <?php
            if(isset($_SESSION['email'])){
                echo "<li><span><a href='php/logout.php'><button href='#' class='btn'>{$t['logout']}</button></a></span></li>";
            } else {
                echo "<li><span><a href='index.php?page=login><button href='#' class='btn'>{$t['login_signup']}</button></a></span></li>";
            }
            ?>
        </ul>
    </nav>-->

    <script>
    function toggleMenu() {
        document.getElementById("nav-menu").classList.toggle("active");
    }
    </script>


</header>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="public/js/search.js"></script>
