// FOR ADMIN

function confirmDeleteBook(bookId) {
    const userConfirmed = confirm(
        "Are you sure you want to delete the book with ID# " + bookId + "?"
    );

    if (userConfirmed) {
        window.location.href =
            "http://programmingbooks-store.free.nf/admin/delete_book/?id=" +
            bookId;
    }
}

function confirmDeleteAuthor(authorId) {
    const userConfirmed = confirm(
        "Are you sure you want to delete the author with ID# " + authorId + "?"
    );

    if (userConfirmed) {
        window.location.href =
            "http://programmingbooks-store.free.nf/admin/delete_author/?id=" +
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
            "http://programmingbooks-store.free.nf/admin/delete_category/?id=" +
            categoryId;
    }
}

function addNewBook() {
    window.location.href =
        "http://programmingbooks-store.free.nf/admin/edit_book";
}

function backToBooksList() {
    window.location.href = "http://programmingbooks-store.free.nf/admin";
}

function addNewCategory() {
    window.location.href =
        "http://programmingbooks-store.free.nf/admin/edit_category";
}

function backToCategoriesList() {
    window.location.href =
        "http://programmingbooks-store.free.nf/admin/categories";
}

function backToAdminOrdersList() {
    window.location.href = "http://programmingbooks-store.free.nf/admin/orders";
}

function updateCategoryName(categoryId) {
    if (this.event.key === "Enter") {
        const categoryName = this.event.target.value; // Get the input value
        window.location.href = `http://programmingbooks-store.free.nf/admin/update_category/?id=${categoryId}&name=${categoryName}`;
    }
}

function updateOrderStatus(orderId) {
    window.location.href = `http://programmingbooks-store.free.nf/admin/update_order_status/?id=${orderId}&status=${this.event.target.value}`;
}

function updateBookStatus(bookId) {
    console.log("book id" + bookId);
    console.log("status: " + this.event.target.value);

    window.location.href = `http://programmingbooks-store.free.nf/admin/update_book_status/?id=${bookId}&status=${this.event.target.value}`;
}

// FOR USERS
function confirmDeleteCartItem(bookId) {
    const userConfirmed = confirm(
        "Are you sure you want to delete the book with ID# " + bookId + "?"
    );

    if (userConfirmed) {
        window.location.href =
            "http://programmingbooks-store.free.nf/cart/delete_from_cart/?id=" +
            bookId;
    }
}

function backToClientBooksList() {
    window.location.href = "http://programmingbooks-store.free.nf/books";
}

function backToClientOrdersList() {
    window.location.href = "http://programmingbooks-store.free.nf/orders";
}

function updateUserPassword() {
    window.location.href =
        "http://programmingbooks-store.free.nf/user/update_user_password";
}

function updateCartItemQty(bookId) {
    if (this.event.key === "Enter") {
        const newQty = this.event.target.value; // Get the input value
        window.location.href = `http://programmingbooks-store.free.nf/cart/update_cart/?book_id=${bookId}&quantity=${newQty}`;
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

// EDIT PROFILE MODAL

// Get modal and trigger elements
const modal = document.getElementById("editProfileModal");
const openModalBtn = document.getElementById("openModalBtn");
const closeModalBtn = document.getElementById("closeModalBtn");

// Open modal when trigger button is clicked
openModalBtn.onclick = function () {
    modal.style.display = "flex"; // Show modal with flex layout (for centering)
};

// Close modal when close button is clicked
closeModalBtn.onclick = function () {
    modal.style.display = "none";
};

// Close modal if user clicks outside the modal content
window.onclick = function (event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
};

// UPDATE PASSWORD MODAL

// Get modal and trigger elements
const updatePasswordModal = document.getElementById("updatePasswordModal");
const openUpdatePasswordModalBtn = document.getElementById(
    "openUpdatePasswordModalBtn"
);
const closeUpdatePasswordModalBtn = document.getElementById(
    "closeUpdatePasswordModalBtn"
);

// Open modal when trigger button is clicked
openUpdatePasswordModalBtn.onclick = function () {
    updatePasswordModal.style.display = "flex"; // Show modal with flex layout (for centering)
};

// Close modal when close button is clicked
closeUpdatePasswordModalBtn.onclick = function () {
    updatePasswordModal.style.display = "none";
};

// Close modal if user clicks outside the modal content
window.onclick = function (event) {
    if (event.target === updatePasswordModal) {
        updatePasswordModal.style.display = "none";
    }
};
