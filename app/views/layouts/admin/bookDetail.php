<?php
$book = $data['book'];

?>

<h1 class="center">Book Detail Page</h1>
<button class="success" onclick="backToBooksList()"><i class="bi bi-chevron-left"></i> Back to Books List</button>

<!-- <button class="button-12"><a href="http://localhost/php_bookstore/admin">Back to Books List</a></button> -->

<div class="book-container">
  <div>
    <img src="<?= $book->image_url ?>" alt="<?= $book->title ?>" class="book-image-detail">
  </div>

  <div class="book-details">
    <h3 class="book-title"><?= $book->title ?></h3>
    <hr>
    <p class="book-price">$<?= number_format($book->price_out, 2, '.', ',')  ?></p>

    <p>
    <p><?= $book->description ?></p>
    </p>
    <hr>
    <p>Author: <?= $book->author ?></p>
    <p>Category: <?= $book->category_name ?></p>

    <hr>
    <div>
      <a href="http://localhost/php_bookstore/admin/edit_book/?id=<?= $book->id ?>"><button class="primary"><i class="bi bi-pen-fill"></i> Edit</button></a>
      <button class="danger" onclick="confirmDeleteBook(<?= $book->id ?>)"><i class="bi bi-trash3-fill"></i> Delete</button>
    </div>
  </div>
</div>