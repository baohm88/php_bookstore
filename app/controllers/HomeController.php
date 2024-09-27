<?php

class HomeController extends BaseController
{
  private $__cartModel;

  function __construct($conn) {}

  function index()
  {
    $data['page'] = 'client/home.php';
    $data['page_title'] = 'Bookstore';
    $this->view('client/clientLayout.php', $data);
  }
}
