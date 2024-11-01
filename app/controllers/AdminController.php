<?php
class AdminController extends BaseController
{
    private $__bookModel, $__categoryModel, $__orderModel;

    function __construct($conn)
    {
        $this->__bookModel = $this->load_model('BookModel', $conn);
        $this->__categoryModel = $this->load_model('CategoryModel', $conn);
        $this->__orderModel = $this->load_model('OrdersModel', $conn);
    }

    // BOOKS CONTROLLER
    public function index()
    {
        // Pagination variables
        $limit = 3; // Number of books per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        $startIndex = $offset + 1;  // This gives the index of the first item on the current page.

        // Check if filters are applied
        $title = isset($_GET['title']) ? trim($_GET['title']) : '';
        $stock_qty = isset($_GET['stock_qty']) ? trim($_GET['stock_qty']) : '';
        $price_in = isset($_GET['price_in']) ? trim($_GET['price_in']) : '';
        $price_out = isset($_GET['price_out']) ? trim($_GET['price_out']) : '';

        // Fetch filtered books or all books based on whether filters are applied
        if ($title || $stock_qty || $price_in || $price_out) {
            $books = $this->__bookModel->filterBooks($title, $stock_qty, $price_in, $price_out, $limit, $offset);
            $totalBooks = $this->__bookModel->countFilteredBooks($title, $stock_qty, $price_in, $price_out);
        } else {
            $books = $this->__bookModel->getAllBooks($limit, $offset);
            $totalBooks = $this->__bookModel->countAllBooks();
        }

        // Calculate total pages
        $totalPages = ceil($totalBooks / $limit);
        $this->view("admin/adminLayout.php", [
            'page'          => 'admin/books.php',
            'page_title'    => 'Books',
            'currentPage'   => $page,
            'title'         => $title,
            'stock_qty'     => $stock_qty,
            'price_in'      => $price_in,
            'price_out'     => $price_out,
            'startIndex'    => $startIndex,
            'books'         => $books,
            'totalBooks'    => $totalBooks,
            'totalPages'    => $totalPages,
        ]);
    }


    function book()
    {
        $bookId = $_REQUEST['id'];
        $book = $this->__bookModel->getBookById($bookId);
        $this->view('admin/adminLayout.php', [
            'page'          => 'admin/bookDetail.php',
            'page_title'    => 'Book Detail',
            'book'          => $book,
        ]);
    }


    function edit_book()
    {
        $categories = $this->__categoryModel->getAllCategories();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_REQUEST['id'])) {
                // edit
                $page_title = 'Edit Book';
                $bookId = $_REQUEST['id'];
                if (!$bookId > 0) {
                    $error  = 'Wrong Book ID. please enter a valid Book ID';
                    $book   = '';
                } else {
                    $book = $this->__bookModel->getBookById($bookId);
                    if (empty($book)) {
                        $error  = 'Book with ID# ' . $bookId . ' is not found!';
                        $book   = '';
                    }
                }
            } else {
                // add new
                $page_title = 'Add New Book';
                $book = '';
            };

            $this->view('admin/adminLayout.php', [
                'page'          => 'admin/book_form.php',
                'page_title'    => $page_title,
                'book'          => $book,
                'categories'    => $categories,
                'error'         => $error ?? '',
            ]);
        } else {
            // method = POST -> collect POST data
            $title          = trim($_POST['title']);
            $author         = trim($_POST['author']);
            $description    = trim($_POST['description']);
            $category_id    = trim($_POST['category_id']);
            $price_in       = trim($_POST['price_in']);
            $price_out      = trim($_POST['price_out']);
            $stock_qty      = trim($_POST['stock_qty']);
            $image_url      = trim($_POST['image_url']);
            $status         = trim($_POST['status']);
            $id             = trim($_POST['id']);

            if ($id > 0) {
                $this->__bookModel->updateBookById($id, $title, $author, $description, $category_id, $price_in, $price_out, $stock_qty, $image_url, $status);
            } else {
                $this->__bookModel->saveBookToDB($title, $author, $description, $category_id, $price_in, $price_out, $stock_qty, $image_url, $status);
            }

            header("Location: http://programmingbooks-store.free.nf/admin");
        }
    }


    function update_book_status()
    {
        $id         = trim($_REQUEST['id']);
        $status     = trim($_REQUEST['status']);
        $this->__bookModel->updateBookStatusById($id, $status);
        header("Location: http://programmingbooks-store.free.nf/admin");
    }

    function delete_book()
    {
        $bookId = $_REQUEST['id'];
        $this->__bookModel->deleteBookById($bookId);
        header("Location: http://programmingbooks-store.free.nf/admin");
    }



    // CATEGORIES CONTROLLER
    public function categories()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // filter categories
            $name   = trim($_POST['name']);
            $dob    = trim($_POST['dob']);
            $categories = $this->__categoryModel->filterCategories($name, $dob);
        } else {
            // show all categories
            $categories = $this->__categoryModel->getAllCategories();
        }
        $this->view("admin/adminLayout.php", [
            'page'          => 'admin/categories.php',
            'page_title'    => 'Categories Page',
            'categories'    => $categories,
        ]);
    }


    function update_category()
    {
        $id     = trim($_REQUEST['id']);
        $name   = trim($_REQUEST['name']);
        $this->__categoryModel->updateCategoryById($id, $name);
        header("Location: http://programmingbooks-store.free.nf/admin/categories");
    }


    function edit_category()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_REQUEST['id'])) {
                // edit
                $page_title = 'Edit Category';
                $categoryId = trim($_REQUEST['id']);
                if (!$categoryId > 0) {
                    $error = 'Wrong Category ID. please enter a valid Category ID';
                    $category = '';
                } else {
                    // get category from db
                    $category = $this->__categoryModel->getCategoryById($categoryId);
                    if (empty($category)) {
                        $error = 'Category with ID# ' . $categoryId . ' is not found!';
                        $category = '';
                    }
                }
            } else {
                // add new
                $page_title = 'Add New Category';
                $category = '';
            };

            $this->view('admin/adminLayout.php', [
                'page'          => 'admin/category_form.php',
                'page_title'    => $page_title,
                'error'         => $error ?? '',
                'category'      => $category,
            ]);
        } else {
            // method = POST -> collect POST data
            $name   = trim($_POST['name']);
            $id     = trim($_POST['id']);
            if ($id > 0) {
                $this->__categoryModel->updateCategoryById($id, $name);
            } else {
                $this->__categoryModel->saveCategoryToDB($name);
            }

            header("Location: http://programmingbooks-store.free.nf/admin/categories");
        }
    }


    function delete_category()
    {
        $categoryId         = trim($_REQUEST['id']);
        $data['category']   = $this->__categoryModel->deleteCategoryById($categoryId);
        header("Location: http://programmingbooks-store.free.nf/admin/categories");
    }



    // ORDERS CONTROLLER
    public function orders()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // filter orders for display
            $name = trim($_POST['name']);
            $dob = trim($_POST['dob']);
            $orders = $this->__orderModel->filterOrders($name, $dob);
        } else {
            // fetch all orders for display
            $orders = $this->__orderModel->getAllOrders();
        }
        $this->view("admin/adminLayout.php", [
            'page'                  => 'admin/orders.php',
            'page_title'            => 'Orders Page',
            'orderStatusOptions'    => ['pending', 'completed', 'canceled'],
            'orders'                => $orders,
        ]);
    }

    public function order_detail()
    {
        $order_id = $_GET['id'];
        $order_items = $this->__orderModel->getUserOrderById($order_id);
        $this->view('admin/adminLayout.php', [
            'page'        => 'admin/orderDetail.php',
            'page_title'  => 'Order# ' . $order_id,
            'order_items' => $order_items
        ]);
    }


    function update_order_status()
    {
        $id         = trim($_REQUEST['id']);
        $status     = trim($_REQUEST['status']);
        $this->__orderModel->updateOrderStatus($id, $status);
        header("Location: http://programmingbooks-store.free.nf/admin/orders");
    }
}
