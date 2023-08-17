<?php

$title = 'Create User';?>
<?php ob_start(); ?>

<h1>Create User </h1>
<a class="btn" href="index.php?page=users">All users</a>
<div class="container" id="create-user-form">
    <form method="POST" action="">
        <div class="form-group mt-1">
            <label for="exampleInputEmail1">Email address</label>
            <input  class="form-control" id="form_text_1" name="login" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group mt-1">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="form_text_2" placeholder="Password">
        </div>
        <div class="form-group mt-1">
            <label for="exampleInputPassword1">Repeat Password</label>
            <input name="confirm_password" type="password" class="form-control" id="form_text_3" placeholder="Password">
        </div>
        <div class="form-group mt-1">
            <label for="exampleFormControlSelect1">Admin</label>
            <select name="is_admin" class="form-control" id="#form_text_4">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

<?php $content = ob_get_clean();
include './app/views/layout.php';