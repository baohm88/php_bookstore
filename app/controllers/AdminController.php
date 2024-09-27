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
    $data['page'] = 'admin/books.php';
    $data['page_title'] = 'Books Page';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // filter books
      $name = trim($_POST['name']);
      $stock_qty = trim($_POST['stock_qty']);
      $price_in = trim($_POST['price_in']);
      $price_out = trim($_POST['price_out']);
      $data['books'] = $this->__bookModel->filterBooks($name, $stock_qty, $price_in, $price_out);
    } else {
      // show all books
      $data['books'] = $this->__bookModel->getAllBooks();
    }
    $this->view("admin/layoutAdmin.php", $data);
  }


  function book()
  {
    $bookId = $_REQUEST['id'];
    $data['page'] = 'admin/bookDetail.php';
    $data['page_title'] = 'Book Detail';
    $data['book'] = $this->__bookModel->getBookById($bookId);
    $this->view('admin/layoutAdmin.php', $data);
  }


  function edit_book()
  {
    $data['page'] = 'admin/book_form.php';
    $data['categories'] = $this->__categoryModel->getAllCategories();

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if (isset($_REQUEST['id'])) {
        // edit existing book
        $data['page_title'] = 'Edit Book';
        $bookId = $_REQUEST['id'];
        if (!$bookId > 0) {
          $data['error'] = 'Wrong Book ID. please enter a valid Book ID';
          $data['book'] = '';
        } else {
          // get book from db
          $data['book'] = $this->__bookModel->getBookById($bookId);
          if (empty($data['book'])) {
            $data['error'] = 'Book with ID# ' . $bookId . ' is not found!';
            $data['book'] = '';
          }
        }
      } else {
        // add new
        $data['page_title'] = 'Add New Book';
        $data['book'] = '';
      };

      $this->view('admin/layoutAdmin.php', $data);
    } else {
      // method = POST -> collect POST data
      $title = trim($_POST['title']);
      $author = trim($_POST['author']);
      $description = trim($_POST['description']);
      $category_id = trim($_POST['category_id']);
      $price_in = $_POST['price_in'];
      $price_out = $_POST['price_out'];
      $stock_qty = $_POST['stock_qty'];
      $image_url = $_POST['image_url'];
      $id = $_POST['id'];
      if ($id > 0) {
        // update book by id
        $this->__bookModel->updateBookById($id, $title, $author, $description, $category_id, $price_in, $price_out, $stock_qty, $image_url);
      } else {
        // save book to db
        $this->__bookModel->saveBookToDB($title, $author, $description, $category_id, $price_in, $price_out, $stock_qty, $image_url);
      }

      header("Location: http://localhost/php_bookstore/admin");
    }
  }


  function delete_book()
  {
    $bookId = $_REQUEST['id'];
    $this->__bookModel->deleteBookById($bookId);
    header("Location: http://localhost/php_bookstore/admin");
  }



  // CATEGORIES CONTROLLER
  public function categories()
  {
    $data['page'] = 'admin/categories.php';
    $data['page_title'] = 'Categories Page';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // filter categories
      $name = trim($_POST['name']);
      $dob = trim($_POST['dob']);
      $data['categories'] = $this->__categoryModel->filterCategories($name, $dob);
    } else {
      // show all categories
      $data['categories'] = $this->__categoryModel->getAllCategories();
    }
    $this->view("admin/layoutAdmin.php", $data);
  }


  function update_category()
  {
    // get id, name
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];

    // update category by id
    $this->__categoryModel->updateCategoryById($id, $name);
    // redirect user to same page
    header("Location: http://localhost/php_bookstore/admin/categories");
  }


  function edit_category()
  {
    $data['page'] = 'admin/category_form.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if (isset($_REQUEST['id'])) {
        // edit
        $data['page_title'] = 'Edit Category';
        $categoryId = $_REQUEST['id'];
        if (!$categoryId > 0) {
          $data['error'] = 'Wrong Category ID. please enter a valid Category ID';
          $data['category'] = '';
        } else {
          // get category from db
          $data['category'] = $this->__categoryModel->getCategoryById($categoryId);
          if (empty($data['category'])) {
            $data['error'] = 'Category with ID# ' . $categoryId . ' is not found!';
            $data['category'] = '';
          }
        }
      } else {
        // add new
        $data['page_title'] = 'Add New Category';
        $data['category'] = '';
      };

      $this->view('admin/layoutAdmin.php', $data);
    } else {
      // method = POST -> collect POST data
      $name = $_POST['name'];
      $id = $_POST['id'];
      if ($id > 0) {
        // update category by id
        $this->__categoryModel->updateCategoryById($id, $name);
      } else {
        // save category to db
        $this->__categoryModel->saveCategoryToDB($name);
      }

      header("Location: http://localhost/php_bookstore/admin/categories");
    }
  }


  function delete_category()
  {
    $categoryId = $_REQUEST['id'];
    $data['category'] = $this->__categoryModel->deleteCategoryById($categoryId);
    header("Location: http://localhost/php_bookstore/admin/categories");
  }



  // ORDERS CONTROLLER
  public function orders()
  {
    $data['page'] = 'admin/orders.php';
    $data['page_title'] = 'Orders Page';
    $data['orderStatusOptions'] = ['pending', 'completed', 'canceled'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // filter orders
      $name = trim($_POST['name']);
      $dob = trim($_POST['dob']);
      $data['orders'] = $this->__orderModel->filterOrders($name, $dob);
    } else {
      // show all orders
      $data['orders'] = $this->__orderModel->getAllOrders();
    }
    $this->view("admin/layoutAdmin.php", $data);
  }

  function update_order_status()
  {
    $id = trim($_REQUEST['id']);
    $status = trim($_REQUEST['status']);

    $this->__orderModel->updateOrderStatus($id, $status);
    show_data($id);
    show_data($status);
    // die();
    header("Location: http://localhost/php_bookstore/admin/orders");
  }

  function edit_order()
  {
    $data['page'] = 'admin/order_form';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if (isset($_REQUEST['id'])) {
        // edit
        $data['page_title'] = 'Edit Order';
        $orderId = $_REQUEST['id'];
        if (!$orderId > 0) {
          $data['error'] = 'Wrong Order ID. please enter a valid Order ID';
          $data['order'] = '';
        } else {
          // get order from db
          $data['order'] = $this->__orderModel->getOrderById($orderId);
          if (empty($data['order'])) {
            $data['error'] = 'Order with ID# ' . $orderId . ' is not found!';
            $data['order'] = '';
          }
        }
      } else {
        // add new
        $data['page_title'] = 'Add New Order';
        $data['order'] = '';
      };

      $this->view('admin/layoutAdmin.php', $data);
    } else {
      // method = POST -> collect POST data
      $name = $_POST['name'];
      $address = $_POST['address'];
      $contact = $_POST['contact'];
      $id = $_POST['id'];
      if ($id > 0) {
        // update order by id
        $this->__orderModel->updateOrderById($id, $name, $address, $contact);
      } else {
        // save order to db
        $this->__orderModel->saveOrderToDB($name);
      }

      header("Location: http://localhost/php_bookstore/admin/orders");
    }
  }
}
