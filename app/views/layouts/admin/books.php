<?php
$books = $data['books'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // filter books
  $name = trim($_POST['name']);
  $stock_qty = trim($_POST['stock_qty']);
  $price_in = trim($_POST['price_in']);
  $price_out = trim($_POST['price_out']);
}
?>

<h2 class="center">List of Books</h2>
<br>

<button class="success" onclick="addNewBook()"><i class="bi bi-plus-lg"></i> Add New Book</button>
<br>

<div class="center">
  <form method="POST">
    <input type="text" name="name" placeholder="Book Name" value="<?= !empty($name) ? $name : '' ?>">
    <input type="number" name="stock_qty" placeholder="Stock Qty" value="<?= !empty($stock_qty) ? $stock_qty : '' ?>">
    <input type="number" name="price_in" placeholder="Price In" value="<?= !empty($price_in) ? $price_in : '' ?>">
    <input type="number" name="price_out" placeholder="Price Out" value="<?= !empty($price_out) ? $price_out : '' ?>">
    <button type="submit" class="success">Search</button>

  </form>
</div>


<?php if (count($books) > 0) : ?>
  <table>
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Stock Qty</th>
      <th>Price In</th>
      <th>Price Out</th>
      <th>Margin / 1 unit</th>
      <th colspan="3" class="center">Actions</th>
    </tr>

    <?php foreach ($books as $book): ?>
      <tr>
        <td><?= $book->id ?></td>
        <td><?= $book->title ?></td>
        <td><?= $book->stock_qty ?></td>
        <td>$<?= number_format($book->price_in, 2, '.', ',') ?></td>
        <td>$<?= number_format($book->price_out, 2, '.', ',') ?></td>
        <td>$<?= number_format(($book->price_out - $book->price_in), 2, '.', ',') ?></td>
        <td class="center"><a href="http://localhost/php_bookstore/admin/book/?id=<?= $book->id ?>"><button class="success"><i class="bi bi-eye-fill"></i> </button></a></td>
        <td class="center"><a href="http://localhost/php_bookstore/admin/edit_book/?id=<?= $book->id ?>"><button class="primary"><i class="bi bi-pen-fill"></i> </button></a></td>
        <td class="center"><button class="danger" onclick="confirmDeleteBook(<?= $book->id ?>)"><i class="bi bi-trash3-fill"></i> </button></td>
      </tr>
    <?php endforeach ?>
  </table>
<?php else : ?>
  <br>
  <br>
  <h1 class="center">No books found!</h1>
<?php endif ?>