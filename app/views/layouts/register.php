<?php
$error;
if (isset($data["error"])) {
  $error = $data["error"];
}
?>

<form method="POST" class="user-form">
  <h2 class="center">Register New Account</h2>
  <br>
  <p class="error-message"><?= isset($error) ? $error : "" ?></p>
  <p><input type="text" name="username" placeholder="Username" autofocus></p>
  <p><input type="password" name="password" placeholder="Password"></p>
  <p><input type="password" name="password2" placeholder="Confirm Password"></p>

  <p class="form-actions">
    <button type="submit" class="success">Register</button>

  </p>
  <br><br>
  <p>Have no account yet? <a href="http://programmingbooks-store.free.nf/user/login">Login</a> here!</p>
</form>