<?php
class OrdersController extends BaseController
{
    private $__ordersModel, $__cartModel;
    public function __construct($conn)
    {
        $this->__ordersModel    = $this->load_model("OrdersModel", $conn);
        $this->__cartModel      = $this->load_model("CartModel", $conn);
    }


    public function createOrder()
    {
        try {
            $user_id        = $_SESSION['user']->id;
            $cartItems      = $_SESSION['cart_items'];
            $totalAmount    = $_POST['totalAmount'];

            $orderId = $this->__ordersModel->createOrder($user_id, $cartItems, $totalAmount);
            if ($orderId > 0) {
                // delete session info
                $_SESSION['cart_items'] = null;
                $_SESSION['totalCartItems'] = null;
                $_SESSION['cart'] = null;
                // redirect the user to orders page
                header('location: http://programmingbooks-store.free.nf/orders');
            } else {
                echo "Error creating order<br>";
            }
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => 'Failed to create order: ' . $e->getMessage()];
        }
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user']->id;
            $user_orders = $this->__ordersModel->getUserOrders($user_id);
        }

        $this->view('client/clientLayout.php', [
            'page'        => 'client/orders.php',
            'page_title'  => 'Orders',
            'user_orders' => $user_orders
        ]);
    }

    public function order()
    {
        if (isset($_SESSION['user'])) {
            $order_id = $_GET['id'];
            $order_items = $this->__ordersModel->getUserOrderById($order_id);
        }

        $this->view('client/clientLayout.php', [
            'page'        => 'client/orderDetail.php',
            'page_title'  => 'Order# ' . $order_id,
            'order_items' => $order_items
        ]);
    }
}
