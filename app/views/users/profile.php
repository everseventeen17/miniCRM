<?php

$title = 'Profile';
ob_start();

?>

    <!-- Основной контент -->
    <div class="container mt-5">
        <h1 class="mb-4">User profile</h1>
        <div class="card">
            <div class="card-body table-responsive" >
                <table class="table table-hover table-responsive">
                    <tbody>
                    <tr>
                        <th scope="row">ID</th>
                        <td><?php echo $user['id']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Имя пользователя</th>
                        <td><?php echo $user['username']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><?php echo $user['email']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email confirmed</th>
                        <td><?php echo $user['email_verification'] ? 'Да' : 'Нет'; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Is admin</th>
                        <td><?php echo $user['is_admin'] ? 'Да' : 'Нет'; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Role</th>
                        <td><?php echo $role['role_name']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Date of crate</th>
                        <td><?php echo $user['created_at']; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <hr class="mt-5">

        <h3 class="mb-4">OTP password generate</h3>
        <h5>Your's OTP code: <?= $otp?></h5>
        <p>Go to teelgramm and find us bot: <a target="_blank" href="https://t.me/mini_crm_bot" >@mini_crm_bot</a>. Push that command <strong>/start</strong> and follow instructions</p>
        <?php
        if($visible): ?>
            <p>That OTP code will be recorded in the database and will be available for authorization via telegram within 1 hour</p>

            <form action="/users/otpstore" method="POST">
                <input type="hidden" name="otp" value="<?=$otp;?>">
                <input type="hidden" name="user_id" value="<?=$_SESSION['user_id'];?>">
                <button type="submit" class="btn btn-primary">Save password</button>
            </form>
        <?php endif ?>
    </div>


<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>