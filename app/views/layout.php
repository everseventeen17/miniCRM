<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/app/views/assets/index.css">

    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="/app/views/assets/index.js"></script>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php?page=users">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php?page=roles">Roles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php?page=register">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php?page=login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php?page=logout">Logout</a>
                </li>
            </ul>
<!--            <p class="login">--><?php //= isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : '' ?><!--</p>-->
        </div>
    </nav>
</div>
<div class="container mt-5">
    <?php echo $content; ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>
</html>