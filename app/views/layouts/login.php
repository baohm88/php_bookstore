<?php
$error;
if (isset($data["error"])) {
  $error = $data["error"];
}
?>

<form method="POST" class="user-form">
  <h2 class="center">Log In</h2>
  <br>
  <p class="error-message"><?= isset($error) ? $error : "" ?></p>
  <p><input type="text" name="username" placeholder="Username" autofocus></p>
  <p><input type="password" name="password" placeholder="Password"></p>

  <p class="form-actions">
    <button type="submit" class="success">Login</button>

  </p>
  <br><br>
  <p>Have no account yet? <a href="http://localhost/php_bookstore/user/register">Register</a> here!</p>
</form>