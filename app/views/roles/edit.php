<?php
$title = 'Edit Role';?>
<?php ob_start(); ?>

<h1>Edit Role</h1>
<a class="btn" href="index.php?page=roles">All roles</a>
<div class="container" id="update-role-form">
    <form method="POST" action="index.php?page=roles&action=update&id=<?=$role['id']?>">
        <div class="form-group mt-1">
            <label>Role Name</label>
            <input class="form-control" id="form_text_0" name="role_name" placeholder="Enter role name" value="<?= $role['role_name'] ?>">
        </div>
        <div class="form-group mt-1">
            <label>Role description</label>
            <textarea  class="form-control" id="form_text_1" rows="10" name="role_description"><?= $role['role_description'] ?></textarea>
        </div>
        <input class="form-control" type="hidden" id="form_text_2" name="id" value="<?= $role['id'] ?>">
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

<?php $content = ob_get_clean();
include './app/views/layout.php';