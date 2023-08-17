<?php
if($_SERVER['REQUEST_URI'] == '/index.php') {
header('Location: /');
exit();
}

$title = 'Home Page';?>
<?php ob_start(); ?>

    <h1> Home page </h1>

<?php $content = ob_get_clean();
include './app/views/layout.php';