<?php
if ($_SESSION['user']) {
  $username = $_SESSION['user']->username;
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
  <header class="flex-container">
    <div>
      <a href="http://localhost/php_bookstore/admin"><img src="http://localhost/php_bookstore/app/assets/images/bookstore.png" alt="book title" class="logo"></a>

    </div>
    <div>
      <ul class="flex-container">
        <li><a href="http://localhost/php_bookstore/admin" class="nav-link <?= ($current_page == 'book' || $current_page == 'admin' || $current_page == 'index' || $current_page == 'edit_book') ? 'active' : '' ?>"><i class="bi bi-book-fill"></i> Books</a></li>
        <li><a href="http://localhost/php_bookstore/admin/categories" class="nav-link <?= ($current_page == 'categories' || $current_page == 'edit_genre') ? 'active' : '' ?>"><i class="bi bi-journal-album"></i> Categories</a></li>
        <li><a href="http://localhost/php_bookstore/admin/orders" class="nav-link <?= ($current_page == 'orders' || $current_page == 'edit_publisher') ? 'active' : '' ?>"><i class="bi bi-house-down-fill"></i> Orders</a></li>
        <?php if (isset($username)): ?>
          <li><a href="http://localhost/php_bookstore/user/logout" class="nav-link"><button class="danger"><i class="bi bi-box-arrow-right"></i> Logout</button></a></li>
          <li> <button class="success">Hi, <?= $username ?> <i class="bi bi-person-square" style="font-size: larger;"></i> </button></li>
        <?php else: ?>
          <li><a href="http://localhost/php_bookstore/user/login" class="nav-link"><button class="success"><i class="bi bi-box-arrow-in-right"></i> Login</button></a></li>
        <?php endif ?>

        <!-- menu icon -->
        <li class="menu-icon" onclick="openNav()">
          <i class="bi bi-list"></i>
        </li>
        <!-- menu icon -->
      </ul>
    </div>
  </header>
  <hr>
  <main>

    <!-- sidebar -->
    <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

      <a href="http://localhost/php_bookstore/admin" class="nav-link <?= ($current_page == 'book' || $current_page == 'admin' || $current_page == 'index' || $current_page == 'edit_book') ? 'active' : '' ?>"><i class="bi bi-book-fill"></i> Books</a>
      <a href="http://localhost/php_bookstore/admin/categories" class="nav-link <?= ($current_page == 'categories' || $current_page == 'edit_genre') ? 'active' : '' ?>"><i class="bi bi-journal-album"></i> Categories</a>
      <a href="http://localhost/php_bookstore/admin/orders" class="nav-link <?= ($current_page == 'orders' || $current_page == 'edit_publisher') ? 'active' : '' ?>"><i class="bi bi-house-down-fill"></i> Orders</a>


      <?php if (isset($username)): ?>
        <a href="http://localhost/php_bookstore/user/logout" class="nav-link"><button class="danger"><i class="bi bi-box-arrow-right"></i> Logout</button></a>
      <?php else: ?>
        <a href="http://localhost/php_bookstore/user/login" class="nav-link"><button class="success"><i class="bi bi-box-arrow-in-right"></i> Login</button></a>
      <?php endif ?>
    </div>
    <!-- sidebar -->