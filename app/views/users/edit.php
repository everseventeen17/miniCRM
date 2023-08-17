<?php
$title = 'Edit User';?>
<?php ob_start(); ?>

<h1>Edit User </h1>
<a class="btn" href="index.php?page=users">All users</a>
<div class="container" id="update-user-form">
    <form method="POST" action="index.php?page=users&action=update&id=<?=$user['id']?>">
        <div class="form-group mt-1">
            <label for="exampleInputEmail1">Email address</label>
            <input  class="form-control" id="form_text_1" name="login" aria-describedby="emailHelp" placeholder="Enter email" value="<?= $user['login'] ?>">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group mt-1">
            <label for="exampleFormControlSelect1">Admin</label>
            <select name="is_admin" class="form-control" id="#form_text_4">
                <option value="1" <?=$user['is_admin'] !== 0 ? 'selected' : '' ?>>Yes</option>
                <option value="0" <?=$user['is_admin'] === 0 ? 'selected' : '' ?>>No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

<?php $content = ob_get_clean();
include './app/views/layout.php';