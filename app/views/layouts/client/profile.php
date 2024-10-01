<?php

$user = $_SESSION['user'];
$genders = ['male', 'female', 'not specified'];

if (isset($data['error'])) {
    $error = $data['error'];
}

?>

<?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success">

        <span class="closebtn" onclick="this.parentElement.style.display='none';"><i class="bi bi-x"></i></span>
        <p><?= htmlspecialchars($_SESSION['success_message']); ?></p>

    </div>
    <?php unset($_SESSION['success_message']); // Clear the success message after displaying 
    ?>
<?php endif; ?>


<div class="profile-container">
    <div class="profile-header">
        <img src="<?= !empty($user->image_url)  ? $user->image_url : 'https://i.pinimg.com/736x/38/63/2e/38632eac71e6ed2d5240bdf499d936fe.jpg' ?>" alt="<?= $user->fullName ?? 'Nguyen Van A' ?>">
        <div>
            <h2><?= $user->fullName ?? 'Nguyen Van A' ?></h2>
            <p>@<?= $user->username ?></p>
        </div>
    </div>

    <div class="table-container">
        <table>

            <?php if (!empty($user->bio)): ?>
                <tr>
                    <th>Bio</th>
                    <td><?= $user->bio ?></td>
                </tr>
            <?php endif ?>

            <?php if (!empty($user->gender)): ?>
                <tr>
                    <th>Gender</th>
                    <td><?= $user->gender ?></td>
                </tr>
            <?php endif ?>

            <?php if (!empty($user->role)): ?>
                <tr>
                    <th>Role</th>
                    <td><?= $user->role ?></td>
                </tr>
            <?php endif ?>

            <?php if (!empty($user->birthday)): ?>
                <tr>
                    <th>Birthday</th>
                    <td><?= $user->birthday ?></td>
                </tr>
            <?php endif ?>

            <?php if (!empty($user->email)): ?>
                <tr>
                    <th>Email</th>
                    <td><?= $user->email ?></td>
                </tr>
            <?php endif ?>

            <?php if (!empty($user->phone)): ?>
                <tr>
                    <th>Phone</th>
                    <td><?= $user->phone ?></td>
                </tr>
            <?php endif ?>

            <?php if (!empty($user->shipping_address)): ?>
                <tr>
                    <th>Shipping Address</th>
                    <td><?= $user->shipping_address ?></td>
                </tr>
            <?php endif ?>

            <tr>
                <th>Joined</th>
                <!-- <td><?= date('F j, Y', strtotime($user->created_at)) ?></td> -->
                <td><?= date('d/m/Y', strtotime($user->created_at)) ?></td>
            </tr>

        </table>
    </div>

    <div class="center">
        <button class="primary" id="openModalBtn"><i class="bi bi-pen-fill"></i> Edit profile</button>
        <button class="warning" onclick="updateUserPassword()"><i class="bi bi-person-fill-lock"></i> Change Password</button>
    </div>


    <!-- The Modal -->
    <div id="editProfileModal" class="modal">
        <div class="modal-content">
            <!-- Close Button -->
            <span class="close" id="closeModalBtn"><i class="bi bi-x"></i></span>

            <!-- Edit Profile Form -->
            <h2 class="center">Edit Profile</h2>
            <form class="form-container" method="POST">
                <label for="image_url">Image URL</label>
                <input type="text" id="image_url" name="image_url" placeholder="Enter your avatar picture link" value="<?= $user->image_url ? $user->image_url : '' ?>">

                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" value="<?= $user->fullName ? $user->fullName : '' ?>">

                <label for="bio">Bio</label>
                <input type="text" id="bio" name="bio" placeholder="Enter a short bio" value="<?= $user->bio ? $user->bio : '' ?>">

                <label for="gender">Gender</label>
                <!-- <input type="text" id="gender" name="gender" placeholder="Enter your gender" value="<?= $user->gender ? $user->gender : '' ?>"> -->
                <select name="gender" id="gender">
                    <?php foreach ($genders as $option): ?>
                        <?php if ($option == $user->gender): ?>
                            <option value="<?= $option ?>" selected><?= $option ?> </option>
                        <?php else: ?>
                            <option value="<?= $option ?>"><?= $option ?> </option>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>

                <label for="birthday">Birthday</label>
                <input type="date" id="birthday" name="birthday" placeholder="Enter your birthday" value="<?= $user->birthday ? $user->birthday : '' ?>">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" value="<?= $user->email ? $user->email : '' ?>">

                <label for="shipping_address">Shipping Address</label>
                <input type="text" id="shipping_address" name="shipping_address" placeholder="Enter your shipping address" value="<?= $user->shipping_address ? $user->shipping_address : '' ?>">

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>




</div>