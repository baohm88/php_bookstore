<?php
$book = $data['book'];
$categories = $data['categories'];

if (isset($data['error'])) {
    $error = $data['error'];
}

?>

<h1 class="center"><?= $data['page_title'] ?></h1>

<button class="success" onclick="backToBooksList()"><i class="bi bi-chevron-left"></i> Back to Books List</button>


<form method="POST" class="book-form">
    <span class="error-message"><?= $error ?? '' ?></span>
    <p>
        <input type="hidden" name="id" value="<?= $book->id ?? 0 ?>">
    </p>

    <p>
        <label>Title: </label>
        <input type="text" name="title" placeholder="Book title" value="<?= $book->title ?? '' ?>">
    </p>

    <p>
        <label>Author: </label>
        <input type="text" name="author" placeholder="Book author" value="<?= $book->author ?? '' ?>">
    </p>

    <p>
        <label>Description: </label>
        <textarea name="description" id="" placeholder="Book description" rows="3"><?= $book->description ?? '' ?></textarea>
    </p>

    <p>
        <label>Category ID: </label>
        <input type="number" name="category_id" placeholder="Category ID" value="<?= $book->category_id ?? '' ?>">
    </p>

    <p>
        <label>Price In: </label>
        <input type="number" name="price_in" placeholder="Price In" value="<?= $book->price_in ?? '' ?>">
    </p>
    <p> </p>
    <p>
        <label>Price Out: </label>
        <input type="number" name="price_out" placeholder="Price Out" value="<?= $book->price_out ?? '' ?>">
    </p>

    <p>
        <label>Stock Quantity: </label>
        <input type="number" name="stock_qty" placeholder="Stock quantity" value="<?= $book->stock_qty ?? '' ?>">
    </p>

    <p>
        <label>Image URL: </label>
        <input type=" text" name="image_url" placeholder="Book Image URL" value="<?= $book->image_url ?? '' ?>">
    </p>

    <p class="form-actions">
        <button type="submit" class="success">Save</button>
    </p>



</form>