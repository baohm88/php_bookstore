<?php
session_start();
require_once 'app/configs/dbconnect.php';
require_once 'app/core/functions.php';
require_once 'app/controllers/BaseController.php';
// require_once 'app/middleware/AuthMiddleware.php';
require_once 'app/App.php';


// $middleware = new AuthMiddleware(["orders", "cart"]);
$app = new App($conn);
// session_destroy();
