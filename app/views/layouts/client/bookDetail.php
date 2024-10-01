<?php
$book = $data['book'];
?>

<button class="success" onclick="backToClientBooksList()"><i class="bi bi-chevron-left"></i> Back to Books List</button>

<div class="book-container">
  <?php if (!empty($book)) : ?>
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
          <form action="http://localhost/php_bookstore/cart/add_to_cart/" method="POST">
            <input type="hidden" name="book_id" value="<?= $book->id ?>">
            <input type="hidden" name="quantity" value=1>
            <p><button class="cart-button">Add to Cart</button></p>
          </form>
        </div>
      </div>
      <hr>
      <div>
        <p><i><?= $book->description ?></i></p>
      </div>

      <hr>
      <div>
        <p>Author: <?= $book->author ?></p>
        <p>Category ID: <?= $book->category_id ?></p>
      </div>


    </div>
  <?php else: ?>
    <h1 class="error-message"><?= $data['error'] ?></h1>
  <?php endif ?>
</div>