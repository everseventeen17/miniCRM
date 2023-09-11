<?php
$title = 'Todo task update';
?>

<?php ob_start(); ?>


    <div class="container" id="update-task-form">
        <form method="POST" class="form form__task-update" action="/todo/tasks/update/<?= $task['id'] ?>">
            <h1>Edit todo task</h1>
            <a class="btn btn-success" href="/todo/tasks">All todo tasks</a>
            <div class="form-group mt-1">
                <label>Todo task title</label>
                <?php if(isAdmin()) : ?>
                <input class="form-control form-control-input" id="form_text_0" name="title" required minlength="2" maxlength="30" placeholder="Enter todo category title" value="<?= $task['title'] ?>">
                <span class="span__error span__error_title">1</span>
                <?php else: ?>
                <p><?= $task['title'] ?></p>
                    <input class="form-control form-control-input" type="hidden" name="title" value="<?= $task['title'] ?>">
                <?php endif; ?>
            </div>
            <div class="form-group mt-1">
                <label>Todo task description</label>
                <?php if(isAdmin()) : ?>
                <textarea class="form-control form-control-input" id="form_text_1" rows="10" name="description" required minlength="2" maxlength="100"><?= $task['description'] ?></textarea>
                <span class="span__error span__error_description">1</span>
                <?php else: ?>
                    <p><?= $task['description'] ?></p>
                    <input class="form-control form-control-input" type="hidden" name="description" value="<?= $task['description'] ?>">
                <?php endif; ?>
            </div>
            <div class="form-group mt-1">
                <label for="exampleFormControlSelect1">Reminder at</label>
                <select name="reminder_at" class="form-control" id="form_text_2">
                    <option value="30_minutes">30 minutes</option>
                    <option value="1_hour">1 hour</option>
                    <option value="12_hours">12 hours</option>
                    <option value="24_hours">24 hours</option>
                    <option value="7_days">7 days</option>
                </select>
            </div>

            <div class="form-group mt-1">
                <?php if(isAdmin()) : ?>
                <label>Category</label>
                <select name="category_id" class="form-control" id="form_text_3">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id'] ?>" <?= $category['id'] == $task['category_id'] ? 'selected' : '' ?>><?php echo $category['title']; ?> </option>
                    <?php endforeach; ?>
                </select>
                <?php endif; ?>
            </div>

            <div class="form-group mt-1">
                <?php if(isAdmin()) : ?>
                <label>Finish date</label>
                <input class="form-control form-control-input" id="form_text_4" name="finish_date"
                       value="<?= $task['finish_date'] !== null ? str_replace(' ', 'T', $task['finish_date']) : '' ?>"
                       placeholder="Enter finish date" type="datetime-local" required>
                <span class="span__error span__error_finish_date">1</span>
                <?php else: ?>
                    <input class="form-control form-control-input" type="hidden" name="finish_date" value="<?= $task['finish_date'] !== null ? str_replace(' ', 'T', $task['finish_date']) : '' ?>">
                <?php endif; ?>
            </div>

            <div class="form-group mt-1">
                <?php if(isAdmin()) : ?>
                <label for="exampleFormControlSelect1">Status</label>
                <select name="status" class="form-control" id="form_text_5">
                    <option value="new" <?= $task['status'] !== 'new' ? 'selected' : '' ?>>New</option>
                    <option value="in_progress" <?= $task['status'] === 'in_progress' ? 'selected' : '' ?>>In
                        progress
                    </option>
                    <option value="completed" <?= $task['status'] === 'completed' ? 'selected' : '' ?>>Completed
                    </option>
                    <option value="hold" <?= $task['status'] === 'hold' ? 'selected' : '' ?>>On hold</option>
                </select>
                <?php else : ?>
                <label for="exampleFormControlSelect1">Status</label>
                <select name="status" class="form-control" id="form_text_5">
                    <option value="in_progress" <?= $task['status'] === 'in_progress' ? 'selected' : '' ?>>In
                        progress
                    </option>
                    <option value="completed" <?= $task['status'] === 'completed' ? 'selected' : '' ?>>Completed
                    </option>
                    <option value="hold" <?= $task['status'] === 'hold' ? 'selected' : '' ?>>On hold</option>
                </select>
                <?php endif; ?>
            </div>

            <div class="form-group mt-1">
                <?php if(isAdmin()) : ?>
                <label for="exampleFormControlSelect1">Priority</label>
                <select name="priority" class="form-control" id="form_text_6">
                    <option value="low" <?= $task['priority'] !== 'low' ? 'low' : '' ?>>Low</option>
                    <option value="medium" <?= $task['priority'] === 'medium' ? 'medium' : '' ?>>Medium</option>
                    <option value="high" <?= $task['priority'] === 'high' ? 'high' : '' ?>>High</option>
                </select>
                <?php else: ?>
                    <input class="form-control form-control-input" type="hidden" name="priority" value="<?= $task['priority'] ?>">
                <?php endif; ?>
            </div>
            <?php if($task['assigned_to'] !== $_SESSION['user_id']) : ?>
            <div class="form-group mt-1">
                <label>Assigned to</label>
                <select name="assigned_to" class="form-control" id="form_text_7">
                    <?php foreach ($users as $user) : ?>
                        <?php if($user['id'] !== $_SESSION['user_id']) : ?>
                            <option value="<?= $user['id'] ?>"><?php echo $user['username']; ?> </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
          <?php else : ?>
            <input class="form-control form-control-input" type="hidden" id="form_text_2" name="assigned_to" value="<?= $task['assigned_to'] ?>">
            <?php endif; ?>
            <div class="row">
                <!-- Tags field -->
                <div class="col-12 col-md-6 mb-3">
                    <label for="tags">Tags</label>
                    <div class="tags-container">
                       <?php
                        $tagNames = array_map(function ($tag) { return $tag['name'];}, $tags);
                        foreach ($tagNames as $tagName) {
                            echo "<div class='tag'>
                            <span>$tagName</span>
                            <button>×</button>
                        </div>";
                        } ?>

                        <input class="form-control form-control-input" type="text" id="tag-input">
                    </div>
                    <input class="form-control form-control-input" type="hidden" name="tags" id="hidden-tags" value="<?= (implode(', ', $tagNames)) ?>">
                </div>
            </div>
            <input class="form-control form-control-input" type="hidden" name="category_id" value="<?= $task['category_id'] ?>">
            <input class="form-control form-control-input" type="hidden" name="user_id" value="<?= $task['user_id'] ?>">
            <input class="form-control form-control-input" type="hidden" id="id" name="id" value="<?= $task['id'] ?>">
            <input class="form-control form-control-input" type="hidden" id="wasted_time" name="wasted_time" value="1">
            <button type="submit" class="btn submit-btn btn-primary mt-3">Submit</button>
        </form>
    </div>

    <script>
        const tagInput = document.querySelector('#tag-input');
        const tagsContainer = document.querySelector('.tags-container');
        const hiddenTags = document.querySelector('#hidden-tags');
        const existingTags = '<?= htmlspecialchars(isset($task['tags']) ? $task['tags'] : '') ?>';

        function createTag(text) {
            const tag = document.createElement('div');
            tag.classList.add('tag');
            const tagText = document.createElement('span');
            tagText.textContent = text;

            const closeButton = document.createElement('button');
            closeButton.innerHTML = '&times;';

            closeButton.addEventListener('click', () => {
                tagsContainer.removeChild(tag);
                updateHiddenTags();
            });

            tag.appendChild(tagText);
            tag.appendChild(closeButton);

            return tag;
        }

        function updateHiddenTags(){
            const tags = tagsContainer.querySelectorAll('.tag span');
            const tagText = Array.from(tags).map(tag => tag.textContent);
            hiddenTags.value = tagText.join(',');
        }

        tagInput.addEventListener('input', (e) => {
            if(e.target.value.includes(',')){
                const tagText = e.target.value.slice(0, -1).trim();
                if (tagText.length > 1) {
                    const tag = createTag(tagText);
                    tagsContainer.insertBefore(tag, tagInput);
                    updateHiddenTags();
                }
                e.target.value = '';
            }
        });

        tagsContainer.querySelectorAll('.tag button').forEach(button =>{
            button.addEventListener('click', () => {
                tagsContainer.removeChild(button.parentElement);
                updateHiddenTags();
            });
        });

    </script>


<?php $content = ob_get_clean();
include './app/views/layout.php';
include './app/views/popups/success.php';
echo $successPopup;