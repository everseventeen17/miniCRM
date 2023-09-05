<?php

$title = 'Create category';
?>
<?php ob_start(); ?>


<div class="container" id="create-category-form">
    <form method="POST" action="/todo/category/store" class="form">
        <h1>Create Category</h1>
        <a class="btn btn-success" href="/todo/category">All categories</a>
        <div class="form-group mt-1">
            <label>Category title</label>
            <input  class="form-control" id="form_text_0" name="title" placeholder="Enter category title" required minlength="2" maxlength="30">
            <span class="span__error span__error_title">1</span>
        </div>
        <div class="form-group mt-1">
            <label>Category description</label>
            <textarea  class="form-control" id="form_text_1" rows="10" name="description" required minlength="2" maxlength="100"></textarea>
            <span class="span__error span__error_description">1</span>
        </div>
        <button type="submit" class="btn submit-btn btn-primary mt-3">Create role</button>
    </form>
</div>


<?php $content = ob_get_clean();

include './app/views/layout.php';
include './app/views/popups/success.php';
echo $successPopup;