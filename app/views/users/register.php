<?php

$title = 'Register User';?>
<?php ob_start(); ?>

    <h1>Registration</h1>
    <div class="container" id="register-user-form">
        <form method="POST" action="">
            <div class="form-group mt-1">
                <label for="exampleInputEmail1">Username</label>
                <input  class="form-control" id="form_text_0" name="username" placeholder="Enter name">
            </div>
            <div class="form-group mt-1">
                <label for="exampleInputEmail1">Email address</label>
                <input  class="form-control" id="form_text_1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
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
            <button type="submit" class="btn btn-primary mt-3">Register</button>
           <span class="ms-3 mt-3 align-middle">Already have an account? You may <a class="" href="/index.php?page=login">Login</a></span>
        </form>
    </div>

<?php $content = ob_get_clean();
include './app/views/layout.php';