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
                    header("Location: http://programmingbooks-store.free.nf/admin");
                } else {
                    // role = client
                    header("Location: http://programmingbooks-store.free.nf/home");
                }
            } else {
                // not logged in yet -> redirect user to login page
                // header("Location: http://programmingbooks-store.free.nf/user/login");
                $data['error'] = 'Wrong username and/or password.';
                $this->view("client/clientLayout.php", $data);
            }
        }
    }


    public function profile()
    {
        $data['page'] = 'client/profile.php';
        $data['page_title'] = 'User Profile';
        if (isset($_SESSION['user'])) {
            $data['user'] = $this->__userModel->getUserByUsername($_SESSION['user']->username);
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                // show profile page
                $this->view("client/clientLayout.php", $data);
            } else {
                // Handling form submission
                $user_id            = $_SESSION['user']->id;
                $image_url          = isset($_POST['image_url']) ? trim($_POST['image_url']) : '';
                $fullName           = isset($_POST['fullName']) ? trim($_POST['fullName']) : '';
                $bio                = isset($_POST['bio']) ? trim($_POST['bio']) : '';
                $gender             = isset($_POST['gender']) ? trim($_POST['gender']) : '';
                $entered_birthday   = isset($_POST['birthday']) ? trim($_POST['birthday']) : '';
                $birthday           = date('Y-m-d', strtotime($entered_birthday)); // Format birthday
                $email              = isset($_POST['email']) ? trim($_POST['email']) : '';
                $shipping_address   = isset($_POST['shipping_address']) ? trim($_POST['shipping_address']) : '';

                $this->__userModel->updateUserProfile($user_id, $image_url, $fullName, $bio, $gender, $birthday, $email, $shipping_address);
                $user = $this->__userModel->getUserByUsername($_SESSION['user']->username);
                $_SESSION["user"] = $user;
                header("Location: http://programmingbooks-store.free.nf/user/profile");
            }
        } else {
            // Redirect to login if no session exists
            header("Location: http://programmingbooks-store.free.nf/user/login");
            exit;
        }
    }


    public function update_user_password()
    {
        $data['page'] = 'update_password.php';
        $data['page_title'] = 'Update User Password';
        $user_id = $_SESSION['user']->id;

        // Handle GET request
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->view("client/clientLayout.php", $data);
        } else { // Handle POST request
            $current_password   = isset($_POST['current_password']) ? trim($_POST['current_password']) : '';
            $new_password       = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
            $confirm_password   = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

            // Validate input
            if (empty($current_password)) {
                $data['error'] = 'Current password is required!';
                $this->view("client/clientLayout.php", $data);
                return;
            }

            if (empty($new_password)) {
                $data['error'] = 'New password is required!';
                $this->view("client/clientLayout.php", $data);
                return;
            }

            if (empty($confirm_password)) {
                $data['error'] = 'Confirm password is required!';
                $this->view("client/clientLayout.php", $data);
                return;
            }

            if ($new_password !== $confirm_password) {
                $data['error'] = 'Passwords must match!';
                $this->view("client/clientLayout.php", $data);
                return;
            }

            // Check if current password matches stored password
            $stored_password = $this->__userModel->getPasswordByUsername($_SESSION['user']->username);

            if ($current_password !== $stored_password->password) {
                $data['error'] = 'Current password is incorrect!';
                $this->view("client/clientLayout.php", $data);
                return;
            }

            // Update password and check for success

            $this->__userModel->updateUserPassword($user_id, $new_password);
            // Set success message and redirect to profile page
            $_SESSION['success_message'] = "Password updated successfully!";
            header("Location: http://programmingbooks-store.free.nf/user/profile");
            exit;

            // $this->view("client/clientLayout.php", [
            //     'page' => 'client/profile.php',
            //     'page_title' => 'User Profile',
            //     'success_message' => 'Password updated successfully!'
            // ]);
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
                header("Location: http://programmingbooks-store.free.nf/user/login");
            } else {
                // if role = client -> redirect to home page
                header("Location: http://programmingbooks-store.free.nf/home/index");
            }
        } else {
            // not logged in -> redirect user to home page
            header("Location: http://programmingbooks-store.free.nf/home/index");
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
                    header("Location: http://programmingbooks-store.free.nf/user/login");
                }
            }
        }
    }
}
