function confirmDeleteBook(bookId) {
  const userConfirmed = confirm(
    "Are you sure you want to delete the book with ID# " + bookId + "?"
  );

  if (userConfirmed) {
    window.location.href =
      "http://localhost/php_bookstore/admin/delete_book/?id=" + bookId;
  }
}

function confirmDeleteAuthor(authorId) {
  const userConfirmed = confirm(
    "Are you sure you want to delete the author with ID# " + authorId + "?"
  );

  if (userConfirmed) {
    window.location.href =
      "http://localhost/php_bookstore/admin/delete_author/?id=" + authorId;
  }
}

function confirmDeleteCategory(categoryId) {
  const userConfirmed = confirm(
    "Are you sure you want to delete the category with ID# " + categoryId + "?"
  );

  if (userConfirmed) {
    window.location.href =
      "http://localhost/php_bookstore/admin/delete_category/?id=" + categoryId;
  }
}

function confirmDeletePublisher(publisherId) {
  const userConfirmed = confirm(
    "Are you sure you want to delete the publisher with ID# " +
      publisherId +
      "?"
  );

  if (userConfirmed) {
    window.location.href =
      "http://localhost/php_bookstore/admin/delete_publisher/?id=" +
      publisherId;
  }
}

function addNewBook() {
  window.location.href = "http://localhost/php_bookstore/admin/edit_book";
}

function backToBooksList() {
  window.location.href = "http://localhost/php_bookstore/admin";
}

function backToClientBooksList() {
  window.location.href = "http://localhost/php_bookstore/books";
}

function addNewCategory() {
  window.location.href = "http://localhost/php_bookstore/admin/edit_category";
}

function backToCategoriesList() {
  window.location.href = "http://localhost/php_bookstore/admin/categories";
}

function checkEnter(event, categoryId) {
  // Check if the Enter key (key code 13) was pressed
  if (event.key === "Enter") {
    const categoryName = event.target.value; // Get the input value
    updateCategoryName(categoryId, categoryName); // Call the function with category_id and category_name
  }
}

function updateCategoryName(categoryId, categoryName) {
  console.log(`Category ID: ${categoryId}, Category Name: ${categoryName}`);
  window.location.href = `http://localhost/php_bookstore/admin/update_category/?id=${categoryId}&name=${categoryName}`;
}
function updateOrderStatus(orderId) {
  console.log("Order Id: " + orderId);
  console.log("Order Status: " + this.event.target.value);

  window.location.href = `http://localhost/php_bookstore/admin/update_order_status/?id=${orderId}&status=${this.event.target.value}`;
}

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
