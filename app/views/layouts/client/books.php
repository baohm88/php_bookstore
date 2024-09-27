<?php
$books = $data['books'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // filter books
  $title = trim($_POST['title']) ?? '';
  $price_out = trim($_POST['price_out']) ?? '';
}
?>

<h1 class="center">Shop our top rated books </h1>

<form method="POST" class="center">
  <input type="text" name="title" placeholder="Book Title" value="<?= !empty($title) ? $title : '' ?>">
  <input type="number" name="price_out" placeholder="Price" value="<?= !empty($price_out) ? $price_out : '' ?>">
  <button type="submit" class="success">Search</button>
</form>
<br>

<div class="books-container">
  <?php if (!empty($books)): ?>
    <?php foreach ($books as $book): ?>
      <div class="book-card center">
        <!-- <a href="http://localhost/shop/book/detail/?id=<?= $book->id ?>"> -->
        <a href="http://localhost/php_bookstore/books/book/?id=<?= $book->id ?>">
          <img src="<?= $book->image_url ?>" alt="<?= $book->$title ?>" class="book-image">
          <br>
          <br>
          <h4 class="book-title"><?= $book->title ?></h4>
        </a>


        <br>
        <p class="book-price">$<?= number_format($book->price_out, 2, '.', ',')  ?></p>
        <br>

        <form action="http://localhost/php_bookstore/cart/addToCart/" method="POST">
          <input type="hidden" name="book_id" value="<?= $book->id ?>">
          <input type="hidden" name="quantity" value=1>
          <p><button class="cart-button">Add to Cart</button></p>
        </form>

      </div>

    <?php endforeach ?>
  <?php else: ?>
    <h3 class="center">There is no books.</h3>
  <?php endif ?>
</div>