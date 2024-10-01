<?php
if (isset($data['error'])) {
    $error = $data['error'];
}
?>

<!-- The Update Password Modal -->
<div>
    <div class="modal-content">
        <!-- Update Password Form -->
        <h2 class="center">Update Password </h2>
        <form class="form-container" method="POST">
            <!-- Error Message -->
            <span class="error-message"><?= isset($error) ? $error :  '' ?></span>

            <label for="current_password">Current Password</label>
            <input type="password" id="current_password" name="current_password" placeholder="Enter your current password" autofocus>

            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter your new password">

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your new password">


            <button type="submit">Save Changes</button>
        </form>
    </div>
</div>