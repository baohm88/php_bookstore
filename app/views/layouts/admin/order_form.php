<?php
$category = $data['category'];

if (isset($data['error'])) {
  $error = $data['error'];
}

?>

<h1 class="center"><?= $data['page_title'] ?></h1>

<button class="success" onclick="backToCategoriesList()">Back to Categories List</button>
<!-- <button class="success"><a href="http://localhost/shop/admin/categories">Back to Categories List</a></button> -->


<form method="POST" class="book-form">
  <span class="error-message"><?= $error ?? '' ?></span>
  <p>
    <input type="hidden" name="id" value="<?= $category->id ?? 0 ?>">
  </p>
  <p>
    <label for="">Category Name: </label>
    <input type="text" name="name" placeholder="Category name" value="<?= $category->name ?? '' ?>">
  </p>

  <p class="form-actions">
    <button type="submit" class="success">Save</button>
  </p>
</form>