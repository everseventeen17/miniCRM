<?php

$title = 'Create task';
?>
<?php ob_start(); ?>


<div class="container" id="create-category-form">
    <form method="POST" action="/todo/tasks/store" class="form">
        <h1>Create task</h1>
        <a class="btn btn-success" href="/todo/tasks">All tasks</a>
        <div class="form-group mt-1">
            <label>Task title</label>
            <input  class="form-control form-control-input" id="form_text_0" name="title" placeholder="Enter task title" required minlength="2" maxlength="30">
            <span class="span__error span__error_title">1</span>
        </div>
        <div class="form-group mt-1">
            <label>Finish date</label>
            <input  class="form-control form-control-input" id="form_text_1" name="finish_date" placeholder="Enter finish date" type="datetime-local" required>
            <span class="span__error span__error_finish_date">1</span>
        </div>
        <div class="form-group mt-1">
            <label>Task description</label>
            <textarea  class="form-control form-control-input" id="form_text_2" rows="10" name="description" required minlength="2" maxlength="100"></textarea>
            <span class="span__error span__error_description">1</span>
        </div>
        <div class="form-group mt-1">
            <label>Category</label>
            <select name="category_id" class="form-control form-control-input" id="form_text_3">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>"><?php echo $category['title']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mt-1">
            <label>Assigned to</label>
            <select name="assigned_to" class="form-control" id="form_text_4">
                <?php foreach ($users as $user) : ?>
                <?php if($user['id'] !== $_SESSION['user_id']) : ?>
                    <option value="<?= $user['id'] ?>"><?php echo $user['username']; ?> </option>
                <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn submit-btn btn-primary mt-3">Create task</button>
    </form>
</div>


<?php $content = ob_get_clean();

include './app/views/layout.php';
include './app/views/popups/success.php';
echo $successPopup;