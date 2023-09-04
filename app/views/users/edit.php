<?php
$title = 'Update user';?>
<?php ob_start(); ?>


<div class="container" id="update-user-form">
    <form method="POST" class="form form__user-update" action="/users/update/<?=$user['id']?>">
        <h1>Edit User </h1>
        <a class="btn btn-success" href="/users">All users</a>
        <div class="form-group mt-1">
            <label for="exampleInputEmail1">Username</label>
            <input class="form-control" id="form_text_0" name="username" required minlength="2" maxlength="30" placeholder="Enter username" value="<?= $user['username'] ?>">
            <span class="span__error span__error_username">1</span>
        </div>
        <div class="form-group mt-1">
            <label for="exampleInputEmail1">Email address</label>
            <input  class="form-control" id="form_text_1" name="email"  type="email" required minlength="2" maxlength="30" aria-describedby="emailHelp" placeholder="Enter email" value="<?= $user['email'] ?>">
            <span class="span__error span__error_email">1</span>
        </div>
        <div class="form-group mt-1">
            <label for="exampleFormControlSelect1">Role</label>
            <select name="role" class="form-control" id="form_text_3">
                <option value="1" <?=$user['role'] !== 0 ? 'selected' : '' ?>>User</option>
                <option value="0" <?=$user['role'] === 1 ? 'selected' : '' ?>>Content Creator</option>
                <option value="1" <?=$user['role'] === 2 ? 'selected' : '' ?>>Editor</option>
                <option value="0" <?=$user['role'] === 3 ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn submit-btn btn-primary mt-3">Submit</button>
    </form>
</div>

<?php $content = ob_get_clean();
include './app/views/layout.php';
include './app/views/popups/success.php';
echo $successPopup;