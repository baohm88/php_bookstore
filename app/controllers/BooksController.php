<?php
class BooksController extends BaseController
{
    private $__bookModel, $__categoryModel, $__orderModel;

    function __construct($conn)
    {
        $this->__bookModel = $this->load_model('BookModel', $conn);
        $this->__categoryModel = $this->load_model('CategoryModel', $conn);
        $this->__orderModel = $this->load_model('OrdersModel', $conn);
    }

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
            $data['books'] = $this->__bookModel->filterActiveBooks($title, $stock_qty, $price_in, $price_out, $limit, $offset);
            $data['totalBooks'] = $this->__bookModel->countFilteredActiveBooks($title, $stock_qty, $price_in, $price_out);
        } else {
            $data['books'] = $this->__bookModel->getAllActiveBooks($limit, $offset);
            $data['totalBooks'] = $this->__bookModel->countAllActiveBooks();
        }

        // Calculate total pages
        $data['totalPages'] = ceil($data['totalBooks'] / $limit);

        // Pass pagination and filter variables to the view
        $data['currentPage'] = $page;
        $data['title'] = $title;
        $data['stock_qty'] = $stock_qty;
        $data['price_in'] = $price_in;
        $data['price_out'] = $price_out;
        $data['page'] = 'client/books.php';
        $data['page_title'] = 'Books';
        $data['startIndex'] = $startIndex;

        $this->view("client/clientLayout.php", $data);
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
