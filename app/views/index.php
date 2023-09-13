<?php
if ($_SERVER['REQUEST_URI'] == '/index.php') {
    header('Location: /');
    exit();
}

$title = 'Home Page'; ?>
<?php ob_start(); ?>

    <h1> Home page </h1>
    <body>
    <div id='calendar'></div>
    </body>

    <script>
        let tasks = <?= $tasksJson;?>;
        const event = tasks.map((task) => {
            return {
                title: task.title,
                start: new Date(task.created_at),
                end: new Date(task.finish_date),
                id: task.id,
            }
        })
        console.log(event)

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: event,
                eventClick: function (info){
                console.log(info)
                    let taskId = info.event.id;
                    let taskUrl = `<?= $path; ?>${taskId}`;
                    window.location.href = taskUrl;
                }
            });
            calendar.render();
        });

    </script>
<?php $content = ob_get_clean();
include './app/views/layout.php';