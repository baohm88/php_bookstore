<?php
$book = $data['book'];
?>

<!-- <button><a href="http://localhost/php_bookstore/books">Back to Books List</a></button> -->
<button class="success" onclick="backToClientBooksList()"><i class="bi bi-chevron-left"></i> Back to Books List</button>

<div class="book-container">
  <div>
    <img src="<?= $book->image_url ?>" alt="Denim Jeans" class="book-image">
  </div>
  <div class="book-details">
    <h3 class="book-title"><?= $book->title ?></h3>
    <hr>
    <div class="flex-container">
      <div>
        <p class="book-price">$<?= number_format($book->price_out, 2, '.', ',')  ?></p>
      </div>
      <div>
        <button class="cart-button">Add to Cart</button>
      </div>
    </div>
    <p><?= $book->description ?></p>
    <hr>
    <p>Author: <?= $book->author ?></p>
    <p>Category ID: <?= $book->category_id ?></p>

  </div>
</div>