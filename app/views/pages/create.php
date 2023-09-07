<?php

$title = 'Create page';
?>
<?php ob_start(); ?>


<div class="container" id="create-page-form">
    <form method="POST" action="/pages/store" class="form">
        <h1>Create page </h1>
        <a class="btn btn-success" href="/pages">All pages</a>
        <div class="form-group mt-1">
            <label>Page name</label>
            <input  class="form-control form-control-input" id="form_text_0" name="page_name" placeholder="Enter page name" required minlength="2" maxlength="30">
            <span class="span__error span__error_page_name">1</span>
        </div>
        <div class="form-group mt-1">
            <label>Page url</label>
            <input  class="form-control form-control-input" id="form_text_1" name="page_url" placeholder="Enter page url" required minlength="2" maxlength="30">
            <span class="span__error span__error_page_url">1</span>
        </div>
        <div class="form-group mt-1">
            <label>Roles</label>
        <?php foreach ($roles as $role): ?>
        <div class="form-check">
            <input  class="form-check-input" id="form_text_2" type="checkbox" name="roles[]" value="<?= $role['id'] ?>">
            <label  class="form-check-label" id="form_text_2" for="roles"><?= $role['role_name']?></label>
        </div>
        <?php endforeach; ?>
            <span class="span__error span__error_role">1</span>
        </div>
        <button type="submit" class="btn submit-btn btn-primary mt-3">Create page</button>
    </form>
</div>


<?php $content = ob_get_clean();

include './app/views/layout.php';
include './app/views/popups/success.php';
echo $successPopup;