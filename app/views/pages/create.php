<?php

$title = 'Create page';
?>
<?php ob_start(); ?>


<div class="container" id="create-page-form">
    <form method="POST" action="" class="form">
        <h1>Create page </h1>
        <a class="btn btn-success" href="index.php?page=pages">All pages</a>
        <div class="form-group mt-1">
            <label>Page name</label>
            <input  class="form-control" id="form_text_0" name="page_name" placeholder="Enter page name" required minlength="2" maxlength="30">
            <span class="span__error span__error_page_name">1</span>
        </div>
        <div class="form-group mt-1">
            <label>Page url</label>
            <input  class="form-control" id="form_text_1" name="page_url" placeholder="Enter page url" required minlength="2" maxlength="30">
            <span class="span__error span__error_page_url">1</span>
        </div>
        <button type="submit" class="btn submit-btn btn-primary mt-3">Create page</button>
    </form>
</div>


<?php $content = ob_get_clean();

include './app/views/layout.php';
include './app/views/popups/success.php';
echo $successPopup;