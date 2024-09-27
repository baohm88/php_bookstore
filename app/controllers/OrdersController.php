<?php
class OrdersController extends BaseController
{
  private $__ordersModel, $__cartModel;
  public function __construct($conn)
  {
    $this->__ordersModel = $this->load_model("OrdersModel", $conn);
    $this->__cartModel = $this->load_model("CartModel", $conn);
  }


  public function createOrder()
  // public function createOrder()
  {
    try {
      $user_id = $_SESSION['user']->id;
      $cartItems = $_SESSION['cart_items'];
      $totalAmount = $_POST['totalAmount'];

      $orderId = $this->__ordersModel->createOrder($user_id, $cartItems, $totalAmount);
      if ($orderId > 0) {
        // delete session info
        $_SESSION['cart_items'] = null;
        $_SESSION['totalCartItems'] = null;
        $_SESSION['cart'] = null;
        // redirect the user to orders page
        header('location: http://localhost/php_bookstore/orders');
      } else {
        echo "Error creating order<br>";
      }
    } catch (Exception $e) {
      return ['status' => 'error', 'message' => 'Failed to create order: ' . $e->getMessage()];
    }
  }

  public function index()
  {
    $data['page'] = 'client/orders.php';
    $data['page_title'] = 'Orders';

    // fetch cart_items
    if (isset($_SESSION['user'])) {
      $user_id = $_SESSION['user']->id;
      $data['user_orders'] = $this->__ordersModel->getUserOrders($user_id);
    }

    $this->view('client/clientLayout.php', $data);
  }
}
