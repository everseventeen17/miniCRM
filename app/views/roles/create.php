<?php

$title = 'Create role';
?>
<?php ob_start(); ?>


<div class="container" id="create-role-form">
    <form method="POST" action="/roles/store" class="form">
        <h1>Create Role </h1>
        <a class="btn btn-success" href="/roles">All roles</a>
        <div class="form-group mt-1">
            <label>Role name</label>
            <input  class="form-control" id="form_text_0" name="role_name" placeholder="Enter role name" required minlength="2" maxlength="30">
            <span class="span__error span__error_role_name">1</span>
        </div>
        <div class="form-group mt-1">
            <label>Role description</label>
            <textarea  class="form-control" id="form_text_1" rows="10" name="role_description" required minlength="2" maxlength="30"></textarea>
            <span class="span__error span__error_role_description">1</span>
        </div>
        <button type="submit" class="btn submit-btn btn-primary mt-3">Create role</button>
    </form>
</div>


<?php $content = ob_get_clean();

include './app/views/layout.php';
include './app/views/popups/success.php';
echo $successPopup;