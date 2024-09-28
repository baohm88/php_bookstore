<?php
$books = $data['books'];
$totalPages = $data['totalPages'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $stock_qty = trim($_POST['stock_qty']);
    $price_in = trim($_POST['price_in']);
    $price_out = trim($_POST['price_out']);
}

// show_data($_SERVER);
?>

<h1 class="center">List of Books</h1>
<br>

<button class="success" onclick="addNewBook()"><i class="bi bi-plus-lg"></i> Add New Book</button>
<br>

<div class="center">
    <!-- <form method="POST" action="http://localhost/php_bookstore/admin/search/">
        <input type="text" name="title" placeholder="Book Title" value="<?= !empty($title) ? $title : '' ?>" autofocus>
        <input type="number" name="stock_qty" placeholder="Stock Qty" value="<?= !empty($stock_qty) ? $stock_qty : '' ?>">
        <input type="number" name="price_in" placeholder="Price In" value="<?= !empty($price_in) ? $price_in : '' ?>">
        <input type="number" name="price_out" placeholder="Price Out" value="<?= !empty($price_out) ? $price_out : '' ?>">
        <button type="submit" class="success">Search</button>
    </form> -->

    <form method="POST" action="">
        <input type="text" name="title" value="<?php echo isset($title) ? htmlspecialchars($title) : ''; ?>" placeholder="Title">
        <input type="number" name="stock_qty" value="<?php echo isset($stock_qty) ? htmlspecialchars($stock_qty) : ''; ?>" placeholder="Stock Quantity">
        <input type="number" name="price_in" value="<?php echo isset($price_in) ? htmlspecialchars($price_in) : ''; ?>" placeholder="Price In">
        <input type="number" name="price_out" value="<?php echo isset($price_out) ? htmlspecialchars($price_out) : ''; ?>" placeholder="Price Out">
        <button type="submit" class="success">Filter</button>
    </form>
</div>


<?php if (count($books) > 0) : ?>
    <div style="overflow-x: auto;">
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
    </div>

<?php else : ?>

    <h1 class="center">No books found!</h1>
<?php endif ?>

<!-- Pagination Links -->
<div class="center">
    <?php if ($page > 1): ?>
        <a href="http://localhost/php_bookstore/admin/?page=<?php echo $page - 1; ?>"><i class="bi bi-caret-left-fill" style="font-weight: 900;"></i></a>
    <?php endif; ?>

    Page <?php echo $page; ?> of <?php echo $totalPages; ?>

    <?php if ($page < $totalPages): ?>
        <a href="http://localhost/php_bookstore/admin/?page=<?php echo $page + 1; ?>"><i class="bi bi-caret-right-fill" style="font-weight: 900;"></i></a>
    <?php endif; ?>
</div>


<!-- Phân trang -->
<div class="center">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="http://localhost/php_bookstore/admin/?page=<?= $i ?>"><?= $i ?></a>
    <?php endfor; ?>
</div>