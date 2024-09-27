<?php
$category = $data['category'];

if (isset($data['error'])) {
  $error = $data['error'];
}

?>

<h1 class="center"><?= $data['page_title'] ?></h1>

<button class="success" onclick="backToCategoriesList()"><i class="bi bi-chevron-left"></i> Back to Categories List</button>

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