<?php
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']->username;
}

if (isset($_SESSION['totalCartItems'])) {
    $total_cart_items = $_SESSION['totalCartItems'];
} else {
    $total_cart_items = 0;
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['page_title'] ?></title>
    <link rel="stylesheet" href="http://localhost/php_bookstore/app/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header>
        <div>
            <a href="http://localhost/php_bookstore/home"><img src="http://localhost/php_bookstore/app/assets/images/bookstore.png" alt="book title" class="logo"></a>
        </div>
        <div>
            <ul class="flex-container">
                <li><a href="http://localhost/php_bookstore/home" class="nav-link <?= ($current_page == 'home' || $current_page == 'index') ? 'active' : '' ?>"><i class="bi bi-house-heart-fill"></i> Home</a></li>
                <li><a href="http://localhost/php_bookstore/books" class="nav-link <?= ($current_page == 'books' || $current_page == 'book') ? 'active' : '' ?>"><i class="bi bi-book-fill"></i> Books</a></li>
                <li><a href="http://localhost/php_bookstore/cart" class="nav-link <?= ($current_page == 'cart') ? 'active' : '' ?>"><i class="bi bi-cart-check-fill"></i> Cart <span class="<?= $total_cart_items > 0 ? 'total_cart_items' : '' ?>"><?= $total_cart_items > 0 ? $total_cart_items : ''  ?></span> </a></li>

                <?php if (isset($username)): ?>
                    <li class="user-account">
                        <button class="success"><strong>Hi, <?= $username ?> <i class="bi bi-person" style="font-size: larger;"></i></strong></button>
                        <div class="user-account-content">
                            <h4>Account</h4>
                            <hr>
                            <p><a href="http://localhost/php_bookstore/user/profile"><i class="bi bi-person-circle"></i> Your profile</a></p>
                            <p><a href="http://localhost/php_bookstore/orders" class="<?= ($current_page == 'orders') ? 'active' : '' ?>"><i class="bi bi-journal-album"></i> Your orders</a></p>
                            <p><a href="http://localhost/php_bookstore/user/logout"><i class="bi bi-box-arrow-right"></i> Logout</a></p>
                        </div>
                    </li>
                <?php else: ?>
                    <li><a href="http://localhost/php_bookstore/user/login"><button class="success"><i class="bi bi-box-arrow-in-right"></i> Login</button></a></li>
                <?php endif ?>

                <li class="menu-icon" onclick="openNav()">
                    <i class="bi bi-list"></i>
                </li>
            </ul>
        </div>
    </header>
    <hr>
    <main>

        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn1" onclick="closeNav()">&times;</a>
            <a href="http://localhost/php_bookstore/home" class="<?= ($current_page == 'home' || $current_page == 'index') ? 'active' : '' ?>"><i class="bi bi-house-heart-fill"></i> Home</a>
            <a href="http://localhost/php_bookstore/books" class="<?= ($current_page == 'books') ? 'active' : '' ?>"><i class="bi bi-book-fill"></i> Books</a>
            <a href="http://localhost/php_bookstore/orders" class="<?= ($current_page == 'orders') ? 'active' : '' ?>"><i class="bi bi-journal-album"></i> Orders</a>
            <a href="http://localhost/php_bookstore/cart" class="<?= ($current_page == 'cart') ? 'active' : '' ?>"><i class="bi bi-cart-check-fill"></i> Cart <span class="<?= $total_cart_items > 0 ? 'total_cart_items' : '' ?>"><?= $total_cart_items > 0 ? $total_cart_items : ''  ?></span> </a>

            <?php if (!isset($username)): ?>
                <a href="http://localhost/php_bookstore/user/login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
            <?php endif ?>
        </div>