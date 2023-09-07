<?php
$title = 'Edit Page';
?>
<?php ob_start(); ?>


    <div class="container" id="update-role-form">
        <h1>Edit page</h1>
        <a class="btn btn-success" href="/pages">All pages</a>
        <form method="POST" class="form form__page-update" action="/pages/update/<?= $page['id'] ?>">
            <div class="form-group mt-1">
                <label>Page Name</label>
                <input class="form-control form-control-input" id="form_text_0" name="page_name" required minlength="2" maxlength="30"
                       placeholder="Enter page name" value="<?= $page['page_name'] ?>">
                <span class="span__error span__error_page_name">1</span>
            </div>
            <div class="form-group mt-1">
                <label>Page url</label>
                <input class="form-control form-control-input" id="form_text_1" name="page_url" required minlength="2" maxlength="30"
                       placeholder="Enter page url" value="<?= $page['page_url'] ?>">
                <span class="span__error span__error_page_url">1</span>
            </div>
            <div class="form-group mt-1">
                <label>Roles</label>
                <?php foreach ($roles as $role): ?>
                    <div class="form-check">
                        <input class="form-check-input" id="form_text_2"
                               type="checkbox" <?php foreach ($rolesArray as $roleId) {
                            echo $roleId == $role['id'] ? 'checked' : '';
                        } ?> name="roles[]" value="<?= $role['id'] ?>">
                        <label class="form-check-label" id="form_text_2" for="roles"><?= $role['role_name'] ?></label>
                    </div>
                <?php endforeach; ?>
                <span class="span__error span__error_role">1</span>
            </div>
            <input class="form-control form-control-input" type="hidden" id="form_text_2" name="id" value="<?= $page['id'] ?>">
            <button type="submit" class="btn submit-btn btn-primary mt-3">Submit</button>
        </form>
    </div>

<?php $content = ob_get_clean();
include './app/views/layout.php';
include './app/views/popups/success.php';
echo $successPopup;