<?php

class HomeController extends BaseController
{
  private $__cartModel;

  function __construct($conn) {}

  function index()
  {
    $this->view('client/clientLayout.php', [
      'page'        => 'client/home.php',
      'page_title'  => 'Bookstore'
    ]);
  }
}
