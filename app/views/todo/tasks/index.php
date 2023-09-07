<?php
$title = 'Todo List'; ?>

<?php ob_start(); ?>


    <h1 class="mb-4">Todo List</h1>
    <a href="/todo/tasks/create" class="btn btn-success mb-3">Create Task</a>
    <div id="tabs">
        <!-- Кнопки -->
        <ul class="tabs-nav">
            <li><a href="#tab-1">All tasks</a></li>
            <li><a href="#tab-2">My tasks</a></li>
            <li><a href="#tab-3">Tasks that I set</a></li>
        </ul>

        <!-- Контент -->
        <div class="tabs-items">
            <div class="tabs-item" id="tab-1">
                <div class="accordion" id="tasks-accordion">
                    <?php foreach ($tasks as $task):?>
                        <div class="accordion-item mb-2">
                            <div class="accordion-header d-flex justify-content-between align-items-center row"
                                 id="task-<?php echo $task['id']; ?>">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed <?= $task['priority'] == 'medium' ? 'task__button-priority-medium' : ''?><?= $task['priority'] == 'high' ? 'task__button-priority-high' : ''?>" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#task-collapse-<?php echo $task['id']; ?>" aria-expanded="false"
                                            aria-controls="task-collapse-<?php echo $task['id']; ?>">
                            <span class="accordion-item__text"><i
                                        class="fa-solid fa-square-up-right"></i> <strong><?php echo $task['title']; ?> </strong> from <?= $task['USER_BY_WHO']['username']?> to <?= $task['USER_TO']['username']?></span>
                                        <span class="accordion-item__text"><i
                                                    class="fa-solid fa-person-circle-question"></i> <?php echo $task['priority']; ?> </span>
                                        <span class="accordion-item__text"><i class="fa-solid fa-hourglass-start"></i><span
                                                    class="due-date"><?php echo $task['finish_date']; ?></span></span>
                                    </button>
                                </h2>
                            </div>
                            <div id="task-collapse-<?php echo $task['id']; ?>" class="accordion-collapse collapse row"
                                 aria-labelledby="task-<?php echo $task['id']; ?>" data-bs-parent="#tasks-accordion">
                                <div class="accordion-body">
                                    <p><strong><i class="fa-solid fa-layer-group"></i>
                                            Category:</strong> <?php echo($task['CATEGORY']['title'] ?? 'N/A'); ?></p>
                                    <p><strong><i class="fa-solid fa-battery-three-quarters"></i>
                                            Status:</strong> <?php echo($task['status']); ?></p>
                                    <p><strong><i class="fa-solid fa-person-circle-question"></i>
                                            Priority:</strong> <?php echo($task['priority']); ?></p>
                                    <p><strong><i class="fa-solid fa-hourglass-start"></i> Due
                                            Date:</strong> <?php echo($task['finish_date']); ?></p>
                                    <p><strong><i class="fa-solid fa-file-prescription"></i>
                                            Description:</strong> <?php echo($task['description'] ?? ''); ?></p>
                                    <div class="d-flex justify-content-end">
                                        <a href="tasks/edit/<?php echo $task['id']; ?>" class="btn btn-primary me-2">Edit</a>
                                        <button class="js-deleteTodoTask btn btn-danger" data-todoTask-id="<?= $task['id'] ?>">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="tabs-item" id="tab-2">
                <div class="accordion" id="tasks-accordion">
                    <?php foreach ($tasks as $task){
                    if($_SESSION['user_id'] == $task['assigned_to']) :?>
                        <div class="accordion-item mb-2">
                            <div class="accordion-header d-flex justify-content-between align-items-center row" id="task-<?php echo $task['id']; ?>">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed <?= $task['priority'] == 'medium' ? 'task__button-priority-medium' : ''?><?= $task['priority'] == 'high' ? 'task__button-priority-high' : ''?>" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#task-collapse-<?php echo $task['id']; ?>" aria-expanded="false"
                                            aria-controls="task-collapse-<?php echo $task['id']; ?>">
                            <span class="accordion-item__text"><i
                                        class="fa-solid fa-square-up-right"></i> <strong><?php echo $task['title']; ?> </strong> from <?= $task['USER_BY_WHO']['username']?> to <?= $task['USER_TO']['username']?></span>
                                        <span class="accordion-item__text"><i
                                                    class="fa-solid fa-person-circle-question"></i> <?php echo $task['priority']; ?> </span>
                                        <span class="accordion-item__text"><i class="fa-solid fa-hourglass-start"></i><span
                                                    class="due-date"><?php echo $task['finish_date']; ?></span></span>
                                    </button>
                                </h2>
                            </div>
                            <div id="task-collapse-<?php echo $task['id']; ?>" class="accordion-collapse collapse row"
                                 aria-labelledby="task-<?php echo $task['id']; ?>" data-bs-parent="#tasks-accordion">
                                <div class="accordion-body">
                                    <p><strong><i class="fa-solid fa-layer-group"></i>
                                            Category:</strong> <?php echo($task['CATEGORY']['title'] ?? 'N/A'); ?></p>
                                    <p><strong><i class="fa-solid fa-battery-three-quarters"></i>
                                            Status:</strong> <?php echo($task['status']); ?></p>
                                    <p><strong><i class="fa-solid fa-person-circle-question"></i>
                                            Priority:</strong> <?php echo($task['priority']); ?></p>
                                    <p><strong><i class="fa-solid fa-hourglass-start"></i> Due
                                            Date:</strong> <?php echo($task['finish_date']); ?></p>
                                    <p><strong><i class="fa-solid fa-file-prescription"></i>
                                            Description:</strong> <?php echo($task['description'] ?? ''); ?></p>
                                    <div class="d-flex justify-content-end">
                                        <a href="tasks/edit/<?php echo $task['id']; ?>" class="btn btn-primary me-2">Edit</a>
                                        <button class="js-deleteTodoTask btn btn-danger" data-todoTask-id="<?= $task['id'] ?>">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php } ?>
                </div>
            </div>
            <div class="tabs-item" id="tab-3">
                <div class="accordion" id="tasks-accordion">
                    <?php foreach ($tasks as $task){
                        if($_SESSION['user_id'] !== $task['assigned_to'] and !empty($task['assigned_to'])) :?>
                            <div class="accordion-item mb-2">
                                <div class="accordion-header d-flex justify-content-between align-items-center row" id="task-<?php echo $task['id']; ?>">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed <?= $task['priority'] == 'medium' ? 'task__button-priority-medium' : ''?><?= $task['priority'] == 'high' ? 'task__button-priority-high' : ''?>" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#task-collapse-<?php echo $task['id']; ?>" aria-expanded="false"
                                                aria-controls="task-collapse-<?php echo $task['id']; ?>">
                            <span class="accordion-item__text"><i
                                        class="fa-solid fa-square-up-right"></i> <strong><?php echo $task['title']; ?> </strong> from <?= $task['USER_BY_WHO']['username']?> to <?= $task['USER_TO']['username']?></span>
                                            <span class="accordion-item__text"><i
                                                        class="fa-solid fa-person-circle-question"></i> <?php echo $task['priority']; ?> </span>
                                            <span class="accordion-item__text"><i class="fa-solid fa-hourglass-start"></i><span
                                                        class="due-date"><?php echo $task['finish_date']; ?></span></span>
                                        </button>
                                    </h2>
                                </div>
                                <div id="task-collapse-<?php echo $task['id']; ?>" class="accordion-collapse collapse row"
                                     aria-labelledby="task-<?php echo $task['id']; ?>" data-bs-parent="#tasks-accordion">
                                    <div class="accordion-body">
                                        <p><strong><i class="fa-solid fa-layer-group"></i>
                                                Category:</strong> <?php echo($task['CATEGORY']['title'] ?? 'N/A'); ?></p>
                                        <p><strong><i class="fa-solid fa-battery-three-quarters"></i>
                                                Status:</strong> <?php echo($task['status']); ?></p>
                                        <p><strong><i class="fa-solid fa-person-circle-question"></i>
                                                Priority:</strong> <?php echo($task['priority']); ?></p>
                                        <p><strong><i class="fa-solid fa-hourglass-start"></i> Due
                                                Date:</strong> <?php echo($task['finish_date']); ?></p>
                                        <p><strong><i class="fa-solid fa-file-prescription"></i>
                                                Description:</strong> <?php echo($task['description'] ?? ''); ?></p>
                                        <div class="d-flex justify-content-end">
                                            <a href="tasks/edit/<?php echo $task['id']; ?>" class="btn btn-primary me-2">Edit</a>
                                            <button class="js-deleteTodoTask btn btn-danger" data-todoTask-id="<?= $task['id'] ?>">
                                                Delete
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>



    <script>
        function updateRemainingTime() {
            const dueDateElements = document.querySelectorAll('.due-date');
            const now = new Date();

            dueDateElements.forEach((element) => {
                const dueDate = new Date(element.textContent);
                const timeDiff = dueDate - now;

                if (timeDiff > 0) {
                    const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));

                    element.textContent = `Days: ${days} Hours: ${hours} Minutes: ${minutes}`;
                } else {
                    element.textContent = 'Time is up';
                }
            });
        }

        updateRemainingTime();
        setInterval(updateRemainingTime, 60000);
    </script>
    <script>
        $(function() {
            var tab = $('#tabs .tabs-items > div');
            tab.hide().filter(':first').show();

            // Клики по вкладкам.
            $('#tabs .tabs-nav a').click(function(){
                tab.hide();
                tab.filter(this.hash).show();
                $('#tabs .tabs-nav a').removeClass('active');
                $(this).addClass('active');
                return false;
            }).filter(':first').click();

            // Клики по якорным ссылкам.
            $('.tabs-target').click(function(){
                $('#tabs .tabs-nav a[href=' + $(this).attr('href')+ ']').click();
            });

            // Отрытие вкладки из хеша URL
            if(window.location.hash){
                $('#tabs-nav a[href=' + window.location.hash + ']').click();
                window.scrollTo(0, $("#" . window.location.hash).offset().top);
            }
        });
    </script>

<?php $content = ob_get_clean();
include './app/views/layout.php';