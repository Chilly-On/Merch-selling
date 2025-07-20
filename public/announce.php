<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include "sub_element/header.php"; ?>
    <h1 class="upper-main" style="background-color: #dcdad4">
        <?php 
            if ($_GET['code'] == 1){
                echo "Sign Up";
            }
            else{
                echo "Notification";
            } 
        ?>  
    </h1>
    <main class="outer-main">
        <div class="inner-main">
            <?php 
                    if ($_GET['code'] == 1){
                        echo "<h1>You have registered an account.</h1>";
                        echo "<a href='Login.php'>Return to sign up page.</a>";
                    }
            ?>
        </div>
    </main>
    <?php include "sub_element/footer.php"; ?>
</body>
</html>