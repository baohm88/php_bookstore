<?php

class BooksController extends BaseController
{
  private $__bookModel;

  function __construct($conn)
  {
    $this->__bookModel = $this->load_model('BookModel', $conn);
  }

  function index()
  {

    $data['page'] = 'client/books.php';
    $data['page_title'] = 'Available Books';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // filter books
      $title = trim($_POST['title']);
      $stock_quantity = '';
      $price_in = '';
      $price_out = trim($_POST['price_out']);
      $data['books'] = $this->__bookModel->filterBooks($title, $price_in, $stock_quantity, $price_out);
    } else {
      // show all books
      $data['books'] = $this->__bookModel->getAllBooks();
    }

    $this->view('client/clientLayout.php', $data);
  }

  function book()
  {
    $bookId = $_REQUEST['id'];
    $data['page'] = 'client/bookDetail.php';
    $data['page_title'] = 'Book Detail';
    $data['book'] = $this->__bookModel->getBookById($bookId);
    $this->view('client/clientLayout.php', $data);
  }
}
