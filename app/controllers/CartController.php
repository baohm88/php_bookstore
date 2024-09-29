<?php
class CartController extends BaseController
{
    private $__bookModel;
    public function __construct($conn)
    {
        $this->__bookModel = $this->load_model('BookModel', $conn);
    }

    public function index()
    {
        $data['page'] = 'client/cart.php';
        $data['page_title'] = 'Bookstore';
        // fetch items from session[cart]
        if (isset($_SESSION['cart'])) {
            $cartItems = $_SESSION['cart'];
            $totalQty = 0;
            $totalAmount = 0;
            $data['cart_items'] = [];
            $_SESSION['cart_items'] = [];

            foreach ($cartItems as $key => $value) {
                // add totalQty
                $totalQty += $value;
                $cart_item = $this->__bookModel->getBookById($key);
                $cart_item->quantity = $value;
                $totalAmount += $value * $cart_item->price_out;
                array_push($data['cart_items'], $cart_item);
                array_push($_SESSION['cart_items'], $cart_item);
            }
            $_SESSION['totalCartItems'] = $totalQty;
            $data['totalAmount'] = $totalAmount;
        }
        $this->view('client/clientLayout.php', $data);
    }


    public function delete_from_cart()
    {
        $book_id = $_REQUEST['id'];
        if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$book_id])) {
            unset($_SESSION['cart'][$book_id]);
        }
        header('location: http://localhost/php_bookstore/cart');
    }


    public function update_cart()
    {
        $book_id = $_REQUEST['book_id'];
        $quantity = $_REQUEST['quantity'];
        if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$book_id])) {
            $_SESSION['cart'][$book_id] = $quantity;
        }
        header('location: http://localhost/php_bookstore/cart');
    }

    public function add_to_cart()
    {
        $data['page'] = 'client/cart.php';
        $data['page_title'] = 'Bookstore';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $book_id = trim($_POST['book_id']);
            $quantity = trim($_POST['quantity']);

            // check if cart exits in SESSION
            if (isset($_SESSION['cart'])) {
                // add new item to cart
                if (array_key_exists($book_id, $_SESSION['cart'])) {
                    $_SESSION['cart'][$book_id] += 1;
                } else {
                    // add item to cart
                    $_SESSION['cart'][$book_id] = $quantity;
                }
            } else {
                // create first item in cart
                $_SESSION['cart'] = [$book_id => $quantity];
            }
        }
        header('location: http://localhost/php_bookstore/cart');
    }
}
