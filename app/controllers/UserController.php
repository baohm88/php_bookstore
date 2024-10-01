<?php
class UserController extends BaseController
{
    private $__userModel, $__cartModel;
    public function __construct($conn)
    {
        $this->__userModel = $this->load_model("UserModel", $conn);
        $this->__cartModel = $this->load_model("CartModel", $conn);
    }

    public function login()
    {
        $data['page'] = 'login.php';
        $data['page_title'] = 'Log In';

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->view("client/clientLayout.php", $data);
        } else {
            $username = trim($_REQUEST["username"]);
            $password = trim($_REQUEST["password"]);
            $user = $this->__userModel->getUserByUsernameAndPassword($username, $password);
            if (isset($user) && $user) {
                $role = $user->role;
                // save user to session
                $_SESSION["user"] = $user;
                if ($role == "admin") {
                    header("Location: http://localhost/php_bookstore/admin");
                } else {
                    // role = client
                    header("Location: http://localhost/php_bookstore/home");
                }
            } else {
                // not logged in yet -> redirect user to login page
                // header("Location: http://localhost/php_bookstore/user/login");
                $data['error'] = 'Wrong username and/or password.';
                $this->view("client/clientLayout.php", $data);
            }
        }
    }


    public function profile()
    {
        if (isset($_SESSION['user'])) {
            $user = $this->__userModel->getUserByUsername($_SESSION['user']->username);
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $this->view("client/clientLayout.php", [
                    'page' => 'client/profile.php',
                    'page_title' => 'User Profile',
                    'user' =>  $user,
                ]);
            } else {
                $user_id            = $_SESSION['user']->id;
                $image_url          = trim($_POST['image_url']);
                $fullName           = trim($_POST['fullName']);
                $bio                = trim($_POST['bio']);
                $gender             = trim($_POST['gender']);
                $entered_birthday   = trim($_POST['birthday']);
                // Convert the birthday to a timestamp and then format it
                $birthday = date('Y-m-d', strtotime($entered_birthday));
                $email              = trim($_POST['email']);
                $shipping_address   = trim($_POST['shipping_address']);
                $this->__userModel->updateUserProfile($user_id, $image_url, $fullName, $bio, $gender, $birthday, $email, $shipping_address);

                header("Location: http://localhost/php_bookstore/user/profile");
            }
        } else {
            header("Location: http://localhost/php_bookstore/user/login");
        }
    }

    public function logout()
    {
        // if logged in -> delete user info from SESSION
        if (isset($_SESSION["user"])) {
            $role = $_SESSION["user"]->role;
            // delete user info from $_SESSION
            $_SESSION["user"] = null;
            $_SESSION["cart"] = null;
            $_SESSION["totalCartItems"] = null;
            $_SESSION["cart_items"] = null;

            if ($role == "admin") {
                // if role = admin -> redirect to login
                header("Location: http://localhost/php_bookstore/user/login");
            } else {
                // if role = client -> redirect to home page
                header("Location: http://localhost/php_bookstore/home/index");
            }
        } else {
            // not logged in -> redirect user to home page
            header("Location: http://localhost/php_bookstore/home/index");
        }
    }

    public function register()
    {
        $data['page'] = 'register.php';
        $data['page_title'] = 'Register New Account';

        // handle GET request
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->view("client/clientLayout.php", $data);
        } else { // handle POST requet
            $username = trim($_REQUEST["username"]);
            $password = trim($_REQUEST["password"]);
            $password2 = trim($_REQUEST["password2"]);

            if ($password == '' || $password2 == '') {
                $data['error'] = 'Password is required';
                $this->view("client/clientLayout.php", $data);
            }

            // check if username already exits in db
            $user = $this->__userModel->getUserByUsername($username);
            // user is set -> output error (username taken)
            if (isset($user) && $user) {
                $data['error'] = 'Username was taken. Please try a another one.';
                $this->view("client/clientLayout.php", $data);
            } else {
                // check if passwords match
                if ($password != $password2) {
                    // output error: 'Passwords must match'
                    $data['error'] = 'Passwords must match';
                    $this->view("client/clientLayout.php", $data);
                } else {
                    // save new user to db
                    $this->__userModel->registerNewUser($username, $password);
                    header("Location: http://localhost/php_bookstore/user/login");
                }
            }
        }
    }
}
