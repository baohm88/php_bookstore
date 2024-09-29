// FOR ADMIN

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
            "http://localhost/php_bookstore/admin/delete_author/?id=" +
            authorId;
    }
}

function confirmDeleteCategory(categoryId) {
    const userConfirmed = confirm(
        "Are you sure you want to delete the category with ID# " +
            categoryId +
            "?"
    );

    if (userConfirmed) {
        window.location.href =
            "http://localhost/php_bookstore/admin/delete_category/?id=" +
            categoryId;
    }
}

function addNewBook() {
    window.location.href = "http://localhost/php_bookstore/admin/edit_book";
}

function backToBooksList() {
    window.location.href = "http://localhost/php_bookstore/admin";
}

function addNewCategory() {
    window.location.href = "http://localhost/php_bookstore/admin/edit_category";
}

function backToCategoriesList() {
    window.location.href = "http://localhost/php_bookstore/admin/categories";
}

function updateCategoryName(categoryId) {
    if (this.event.key === "Enter") {
        const categoryName = this.event.target.value; // Get the input value
        window.location.href = `http://localhost/php_bookstore/admin/update_category/?id=${categoryId}&name=${categoryName}`;
    }
}

function updateOrderStatus(orderId) {
    window.location.href = `http://localhost/php_bookstore/admin/update_order_status/?id=${orderId}&status=${this.event.target.value}`;
}

// FOR USERS
function confirmDeleteCartItem(bookId) {
    const userConfirmed = confirm(
        "Are you sure you want to delete the book with ID# " + bookId + "?"
    );

    if (userConfirmed) {
        window.location.href =
            "http://localhost/php_bookstore/cart/delete_from_cart/?id=" +
            bookId;
    }
}

function backToClientBooksList() {
    window.location.href = "http://localhost/php_bookstore/books";
}

function updateCartItemQty(bookId) {
    if (this.event.key === "Enter") {
        const newQty = this.event.target.value; // Get the input value
        window.location.href = `http://localhost/php_bookstore/cart/update_cart/?book_id=${bookId}&quantity=${newQty}`;
    }
}

// NAV
function openNav() {
    document.getElementById("mySidenav").style.width = "200px";
    document.html.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.body.style.backgroundColor = "rgb(245, 245, 247)";
}
