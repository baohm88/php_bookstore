<?php
class BooksController extends BaseController
{
    private $__bookModel;

    function __construct($conn)
    {
        $this->__bookModel = $this->load_model('BookModel', $conn);
    }

    public function index()
    {
        // Pagination variables
        $limit      = 3; // Number of books per page
        $page       = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset     = ($page - 1) * $limit;
        $startIndex = $offset + 1;  // This gives the index of the first item on the current page.

        // Check if filters are applied
        $title      = isset($_GET['title']) ? trim($_GET['title']) : '';
        $stock_qty  = isset($_GET['stock_qty']) ? trim($_GET['stock_qty']) : '';
        $price_in   = isset($_GET['price_in']) ? trim($_GET['price_in']) : '';
        $price_out  = isset($_GET['price_out']) ? trim($_GET['price_out']) : '';

        // Fetch filtered books or all books based on whether filters are applied
        if ($title || $stock_qty || $price_in || $price_out) {
            $books = $this->__bookModel->filterActiveBooks($title, $stock_qty, $price_in, $price_out, $limit, $offset);
            $totalBooks = $this->__bookModel->countFilteredActiveBooks($title, $stock_qty, $price_in, $price_out);
        } else {
            $books = $this->__bookModel->getAllActiveBooks($limit, $offset);
            $totalBooks = $this->__bookModel->countAllActiveBooks();
        }

        $this->view("client/clientLayout.php", [
            'page'          => 'client/books.php',
            'page_title'    => 'Books',
            'books'         => $books,
            'title'         => $title,
            'stock_qty'     => $stock_qty,
            'price_in'      => $price_in,
            'price_out'     => $price_out,
            'startIndex'    => $startIndex,
            'currentPage'   => $page,
            'totalPages'    => ceil($totalBooks / $limit),
        ]);
    }


    function book()
    {
        $bookId = $_REQUEST['id'];
        $book = $this->__bookModel->getActiveBookById($bookId);
        if (empty($book)) {
            $error = 'Book with ID#' . $bookId . ' is not found';
        }

        $this->view('client/clientLayout.php', [
            'page'          => 'client/bookDetail.php',
            'page_title'    => 'Book Detail',
            'book'          => $book ?? '',
            'error'         => $error ?? '',
        ]);
    }
}
