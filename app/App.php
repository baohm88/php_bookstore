<?php

class App
{
  private $__controller, $__method, $__params, $__conn, $__middleware;

  function __construct($conn, $middleware)
  {
    // set default controller, method, params
    $this->__controller = 'home';
    $this->__method = 'index';
    $this->__params = [];
    $this->__conn = $conn;
    $this->__middleware = $middleware;
    $this->handleUrl();
  }

  function getUrl()
  {
    if (!empty($_SERVER['PATH_INFO'])) {
      return $_SERVER['PATH_INFO'];
    }
    return null;
  }

  function handleUrl()
  {
    $url = strtolower($this->getUrl());

    if (!empty($url)) {
      $url = array_values(array_filter(explode('/', $url)));
      $middlewareUrl = $url;

      // 1. handle controller
      if (!empty($url[0])) {
        $this->__controller = ucfirst($url[0]) . 'Controller';
      } else {
        $this->__controller = $this->__controller . 'Controller';
      }

      // 1.1 check if file controller exists
      $controller_file = "app/controllers/" . $this->__controller . ".php";
      if (file_exists($controller_file)) {
        require_once $controller_file; // import $controller_file

        // 1.1 check if class
        if (class_exists($this->__controller)) {
          // instantiate a new obj with respective class
          $this->__controller = new $this->__controller($this->__conn);
          unset($url[0]); // remove 1st value in the urlArr -> controller
          $url = array_values($url);
        } else {
          load_error('404');
        }
      } else {
        load_error('404'); // output error
      }

      // 2. handle method
      if (!empty($url[0])) {
        $this->__method = $url[0];
        unset($url[0]);
        $url = array_values($url);
      }

      // 3. handle params
      $this->__params = array_values($url);

      // 4. check if method exists -> execute the method
      if (method_exists($this->__controller, $this->__method)) {
        // grant access to specified path using AuthMiddleware

        $this->__middleware->authorize_user($middlewareUrl);

        // execute the method inside the controller with params entered by user
        call_user_func_array([$this->__controller, $this->__method], $this->__params);
      } else {
        load_error('404');
      }
    } else {
      load_error('404');
    }
  }
}
