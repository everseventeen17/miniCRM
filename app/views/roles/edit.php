<?php
$title = 'Role update';?>
<?php ob_start(); ?>


<div class="container" id="update-role-form">
    <form method="POST" class="form form__role-update" action="/roles/update/<?=$role['id']?>">
        <h1>Edit Role</h1>
        <a class="btn btn-success" href="index.php?page=roles">All roles</a>
        <div class="form-group mt-1">
            <label>Role Name</label>
            <input class="form-control" id="form_text_0" name="role_name" required minlength="2" maxlength="30" placeholder="Enter role name" value="<?= $role['role_name'] ?>">
            <span class="span__error span__error_role_name">1</span>
        </div>
        <div class="form-group mt-1">
            <label>Role description</label>
            <textarea  class="form-control" id="form_text_1" rows="10" name="role_description" required minlength="2" maxlength="30"><?= $role['role_description'] ?></textarea>
            <span class="span__error span__error_role_description">1</span>
        </div>
        <input class="form-control" type="hidden" id="form_text_2" name="id" value="<?= $role['id'] ?>">
        <button type="submit" class="btn submit-btn btn-primary mt-3">Submit</button>
    </form>
</div>

<?php $content = ob_get_clean();
include './app/views/layout.php';
include './app/views/popups/success.php';
echo $successPopup;