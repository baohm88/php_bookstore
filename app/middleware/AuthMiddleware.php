<?php
class AuthMiddleware
{
  private $__paths = []; // paths that require login

  public function __construct(array $paths)
  {
    $this->__paths = $paths;
  }

  // function to check if path requires login
  public function authorize_user($middlewareUrl)
  {
    //$middlewareUrl -> view App.php line 71)
    $controller = $middlewareUrl[0];
    // $action = $middlewareUrl[1];

    // 1. check if controller = admin
    if ($controller == "admin") {

      // 2. check if admin logged in?
      if (isset($_SESSION["user"])) {

        // if YES -> get role from $_SESSION["user"]
        $role = $_SESSION["user"]->role;

        // 3. check if role == 'admin'
        if ($role != "admin") {
          // output 403 (unauthorized access)
          load_error('403');
        }
      } else {
        // $_SESSION["user"] is unset -> not logged in -> redirect user to login page
        header("Location: http://programmingbooks-store.free.nf/user/login");
      }
    } else {
      // other routes (controllers) which are not 'admin'
      // user that's not logged in 
      if (!isset($_SESSION["user"])) {
        // check if path = admin but require login
        // if (in_array($controller . "/" . $action, $this->__paths)) {
        if (in_array($controller, $this->__paths)) {
          // redirect user to login page
          header("Location: http://programmingbooks-store.free.nf/user/login");
        }
      }
    }
  }
}
