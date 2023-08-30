<?php
$title = 'Edit Page';?>
<?php ob_start(); ?>


<div class="container" id="update-role-form">
    <form method="POST" action="index.php?page=roles&action=update&id=<?=$role['id']?>">
        <h1>Edit page</h1>
        <a class="btn" href="index.php?page=pages">All pages</a>
        <div class="form-group mt-1">
            <label>Page Name</label>
            <input class="form-control" id="form_text_0" name="page_name" placeholder="Enter page name" value="<?= $page['page_name'] ?>">
        </div>
        <div class="form-group mt-1">
            <label>Page url</label>
            <input class="form-control" id="form_text_1" name="page_url" placeholder="Enter page url" value="<?= $page['page_url'] ?>">
        </div>
        <input class="form-control" type="hidden" id="form_text_2" name="id" value="<?= $page['id'] ?>">
        <button type="submit" class="btn submit-btn btn-primary mt-3">Submit</button>
    </form>
</div>

<?php $content = ob_get_clean();
include './app/views/layout.php';