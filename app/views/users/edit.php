<?php
$title = 'Edit UserModel';?>
<?php ob_start(); ?>


<div class="container" id="update-user-form">
    <form method="POST" action="index.php?page=users&action=update&id=<?=$user['id']?>">
        <h1>Edit User </h1>
        <a class="btn" href="index.php?page=users">All users</a>
        <div class="form-group mt-1">
            <label for="exampleInputEmail1">Username</label>
            <input class="form-control" id="form_text_0" name="username" placeholder="Enter username" value="<?= $user['username'] ?>">
        </div>
        <div class="form-group mt-1">
            <label for="exampleInputEmail1">Email address</label>
            <input  class="form-control" id="form_text_1" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?= $user['email'] ?>">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
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