<?php

$title = 'Register user';?>
<?php ob_start(); ?>
    <div class="container" id="register-user-form">
        <form method="POST" action="/auth/store" class="form form__user-registration">
            <h1>Registration</h1>
            <div class="form-group mt-1">
                <label for="exampleInputEmail1">Username</label>
                <input  class="form-control form-control-input" id="form_text_0" name="username" placeholder="Enter name" required minlength="2" maxlength="30">
                <span class="span__error span__error_username">1</span>
            </div>
            <div class="form-group mt-1">
                <label for="exampleInputEmail1">Email address</label>
                <input  class="form-control form-control-input" id="form_text_1" name="email" aria-describedby="emailHelp" type="email" placeholder="Enter email" required minlength="2" maxlength="30">
                <span class="span__error span__error_email">1</span>
            </div>
            <div class="form-group mt-1">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control form-control-input" id="form_text_2" placeholder="Password" required minlength="2" maxlength="30">
                <span class="span__error span__error_password">1</span>
            </div>
            <div class="form-group mt-1">
                <label for="exampleInputPassword1">Repeat Password</label>
                <input name="confirm_password" type="password" class="form-control form-control-input" id="form_text_3" placeholder="Password" required minlength="2" maxlength="30">
                <span class="span__error span__error_confirm_password">1</span>
            </div>
            <button type="submit" class="btn submit-btn btn-primary mt-3">Register</button>
           <span class="ms-3 mt-3 align-middle">Already have an account? You may <a class="" href="/auth/login">Login</a></span>
        </form>
    </div>

<?php $content = ob_get_clean();
include './app/views/layout.php';
include './app/views/popups/success.php';
echo $successPopup;