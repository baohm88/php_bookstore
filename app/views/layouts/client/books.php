<?php
$books = $data['books'];
$totalPages = $data['totalPages'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = $data['currentPage'];
$index = $data['startIndex'];
$title = isset($_GET['title']) ? trim($_GET['title']) : '';
$stock_qty = isset($_GET['stock_qty']) ? trim($_GET['stock_qty']) : '';
$price_in = isset($_GET['price_in']) ? trim($_GET['price_in']) : '';
$price_out = isset($_GET['price_out']) ? trim($_GET['price_out']) : '';
?>

<h1 class="center">Shop our top rated books </h1>

<div class="center">
    <form method="GET" action="">
        <input type="text" name="title" value="<?php echo isset($title) ? htmlspecialchars($title) : ''; ?>" placeholder="Title">
        <input type="number" name="price_out" value="<?php echo isset($price_out) ? htmlspecialchars($price_out) : ''; ?>" placeholder="Price Out">
        <button type="submit" class="success">Search</button>
    </form>
</div>
<br>

<div class="books-container">
    <?php if (!empty($books)): ?>
        <?php foreach ($books as $book): ?>
            <div class="book-card center">
                <a href="http://localhost/php_bookstore/books/book/?id=<?= $book->id ?>">
                    <img src="<?= $book->image_url ?>" alt="<?= $book->$title ?>" class="book-image">
                    <h4 class="book-title"><?= $book->title ?></h4>
                </a>
                <p class="book-price">$<?= number_format($book->price_out, 2, '.', ',')  ?></p>
                <form action="http://localhost/php_bookstore/cart/add_to_cart/" method="POST">
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

<!-- Pagination Links -->
<br>
<div class="center">
    <?php if ($page > 1): ?>
        <a href="http://localhost/php_bookstore/books/?page=<?= $page - 1 ?>&title=<?= urlencode($title) ?>&stock_qty=<?= urlencode($stock_qty) ?>&price_in=<?= urlencode($price_in) ?>&price_out=<?= urlencode($price_out) ?>">
            <i class="bi bi-caret-left-fill" style="font-weight: 900;"></i>
        </a>
    <?php endif; ?>

    Page <?= $page ?> of <?= $totalPages ?>

    <?php if ($page < $totalPages): ?>
        <a href="http://localhost/php_bookstore/books/?page=<?= $page + 1 ?>&title=<?= urlencode($title) ?>&stock_qty=<?= urlencode($stock_qty) ?>&price_in=<?= urlencode($price_in) ?>&price_out=<?= urlencode($price_out) ?>">
            <i class="bi bi-caret-right-fill" style="font-weight: 900;"></i>
        </a>
    <?php endif; ?>
</div>