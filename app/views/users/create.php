<?php

$title = 'Create user';?>
<?php ob_start(); ?>

<h1>Create User </h1>
<a class="btn btn-success" href="index.php?page=users">All users</a>
<div class="container" id="create-user-form">
    <form method="POST" class ="form" action="">
        <div class="form-group mt-1">
            <label for="exampleInputEmail1">Username</label>
            <input  class="form-control" id="form_text_0" name="username" placeholder="Enter name" required minlength="2" maxlength="30">
            <span class="span__error span__error_username">1</span>
        </div>
        <div class="form-group mt-1">
            <label for="exampleInputEmail1">Email address</label>
            <input  class="form-control" id="form_text_1" name="email" aria-describedby="emailHelp" placeholder="Enter email" required type="email" >
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            <span class="span__error span__error_email">1</span>
        </div>
        <div class="form-group mt-1">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="form_text_2" placeholder="Password" required  minlength="2">
            <span class="span__error span__error_password">1</span>
        </div>
        <div class="form-group mt-1">
            <label for="exampleInputPassword1">Repeat Password</label>
            <input name="confirm_password" type="password" class="form-control" id="form_text_3" placeholder="Password" required minlength="2">
            <span class="span__error span__error_confirm_password">1</span>
        </div>
        <button type="submit" class="btn submit-btn btn-primary mt-3">Submit</button>
    </form>
</div>

<?php $content = ob_get_clean();
include './app/views/layout.php';
include './app/views/popups/success.php';
echo $successPopup;