<?php
session_start();
include 'config.php';

/*if (isset($_GET['signout'])) {
    include 'src/Views/signout.php';
    exit;
}*/

if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'en';

include "php/lang.php";
$currentLang = $_SESSION['lang'] ?? 'en';
$t = $lang_strings[$currentLang];
global $t;

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        include 'view/Home.php';
        break;
    case 'product':
        include 'view/Product_Service.php';
        break;
    case 'category':
        include 'view/Category.php';
        break;
    case 'contact':
        include 'view/Contact.php';
        break;
    case 'login':
        include 'view/Login.php';
        break;
    case 'signUp':
        include 'view/Sign_up.php';
        break;
    case 'admin':
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            include 'view/Admin.php';
        } else {
            include 'view/401.php'; // unauthorized page
        }
        break;
    case 'annouce':
        include 'view/Annouce.php';
        break;
    case 'product_desc':
        include 'view/Product_Description.php';
        break;
    default:
        include 'view/404.php';
        break;
}
?>