<?php
$host = "mysql:host=sql205.infinityfree.com:3306;dbname=if0_37631374_php_bookstore";
$username = "if0_37631374";
$pass = "3yVC5WzVXT";
try {
    $conn = new PDO($host, $username, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo "connection failed: " . $ex->getMessage();
}
