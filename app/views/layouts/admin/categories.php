<?php
$categories = $data['categories'];
?>

<h1 class="center">List of Categories</h1>
<br>

<button class="success" onclick="addNewCategory()"><i class="bi bi-plus-lg"></i> Add New Category</button>
<br>
<br>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>

            <th class="center">Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td><?= $category->id ?></td>
                <td>
                    <input type="text" name="name" value="<?= $category->name ?>" placeholder="Enter category name" onkeydown="updateCategoryName(<?= $category->id ?>)">
                </td>

                <td class="center"><button class="danger" onclick="confirmDeleteCategory(<?= $category->id ?>)"><i class="bi bi-trash3-fill"></i> </button></td>
            </tr>
        <?php endforeach ?>
    </tbody>



</table>