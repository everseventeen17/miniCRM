<?php
$title = 'Todo category update';?>
<?php ob_start(); ?>


<div class="container" id="update-category-form">
    <form method="POST" class="form form__category-update" action="/todo/category/update/<?=$category['id']?>">
        <h1>Edit todo category</h1>
        <a class="btn btn-success" href="/todo/category">All todo categories</a>
        <div class="form-group mt-1">
            <label>Todo category title</label>
            <input class="form-control form-control-input" id="form_text_0" name="title" required minlength="2" maxlength="30" placeholder="Enter todo category title" value="<?= $category['title'] ?>">
            <span class="span__error span__error_title">1</span>
        </div>
        <div class="form-group mt-1">
            <label>Todo category description</label>
            <textarea  class="form-control form-control-input" id="form_text_1" rows="10" name="description" required minlength="2" maxlength="100"><?= $category['description'] ?></textarea>
            <span class="span__error span__error_description">1</span>
        </div>
        <input class="form-control form-control-input" type="hidden" id="form_text_2" name="id" value="<?= $category['id'] ?>">
        <button type="submit" class="btn submit-btn btn-primary mt-3">Submit</button>
    </form>
</div>

<?php $content = ob_get_clean();
include './app/views/layout.php';
include './app/views/popups/success.php';
echo $successPopup;