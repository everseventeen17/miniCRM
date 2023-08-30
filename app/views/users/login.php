<?php

$title = 'Login';?>
<?php ob_start(); ?>

    <div class="container" id="login-user-form">
        <form method="POST" action="" class="form">
            <h1>Login</h1>
            <div class="form-group mt-1">
                <label for="exampleInputEmail1">Email address</label>
                <input  class="form-control" id="form_text_1" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email" required minlength="2" maxlength="30">
                <span class="span__error span__error_email">1</span>
            </div>
            <div class="form-group mt-1">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="form_text_2" placeholder="Password" required minlength="2" maxlength="30">
                <span class="span__error span__error_password">1</span>
            </div>
            <div class="form-check mt-3">
                <input class="form-check-input" name="remember_me" type="checkbox" checked value="0" id="form_checkbox">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div>
            <button type="submit" class="btn submit-btn btn-primary mt-3">Login</button>
           <span class="ms-3 mt-3 align-middle">Didn't have an account? You may <a class="" href="/index.php?page=register">Register</a></span>
        </form>
    </div>

<?php $content = ob_get_clean();
include './app/views/layout.php';
include './app/views/popups/success.php';
echo $successPopup;