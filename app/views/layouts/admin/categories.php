<?php
$categories = $data['categories'];
?>

<h1 class="center">List of Categories</h1>
<br>

<button class="success" onclick="addNewCategory()"><i class="bi bi-plus-lg"></i> Add New Category</button>
<!-- <button class="success"><a href="http://localhost/php_bookstore/admin/edit_category"><i class="bi bi-plus-lg"></i> Add New Category</a></button> -->
<br>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>

    <th class="center">Actions</th>
  </tr>

  <?php foreach ($categories as $category): ?>
    <tr>
      <td><?= $category->id ?></td>
      <td>
        <input type="text" name="name" value="<?= $category->name ?>" placeholder="Enter category name" onkeydown="checkEnter(event, <?= $category->id ?>)">
        <form action="">
        </form>
      </td>
      <!-- <td><?= $category->name ?></td> -->
      <!-- <td class="center"><a href="http://localhost/php_bookstore/admin/edit_category/?id=<?= $category->id ?>"><button class="primary"><i class="bi bi-pen-fill"></i> Edit</button></a></td> -->
      <td class="center"><button class="danger" onclick="confirmDeleteCategory(<?= $category->id ?>)"><i class="bi bi-trash3-fill"></i> </button></td>
    </tr>
  <?php endforeach ?>

</table>