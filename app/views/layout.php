<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- jquery 3.6.4/  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- fontawesome ||  https://kit.fontawesome.com/  -->
    <script src="https://kit.fontawesome.com/fa8a90309e.js" crossorigin="anonymous"></script>
    <!-- fullcalendar ||  https://fullcalendar.io/  -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <title><?=$title?></title>
    <link rel="icon" type="image/x-icon" href="/app/assets/images/favico.png">
    <script src="/app/assets/index.js"></script>
    <link rel="stylesheet" href="/app/assets/index.css">
</head>
<body>



<nav class="navbar">
    <div class="container">
        <div class="navbar__wrap">

            <?php
            if(isset($_SESSION['user_id']) and !empty($_SESSION['user_id'])){?>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-circle-user fa-xl" style="color: #ffffff;"></i>
                        <span class="d-none d-sm-inline mx-1"><?=$_COOKIE['user_name']?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="/users/profile">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/auth/logout">Sign out</a></li>
                    </ul>
                </div>
            <?php }else{?>
                <div class="dropdown">
                    <a href="" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-circle-user fa-xl" style="color: #ffffff;"></i>
                        <span class="d-none d-sm-inline mx-1">Sign in</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="/auth/login">Login</a></li>
                        <li><a class="dropdown-item" href="/auth/register">Register</a></li>
                    </ul>
                </div>
            <?php } ?>
            <div class="hamb">
                <div class="hamb__field" id="hamb">
                    <span class="bar"></span> <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="hamburger_wrapper" id="popup">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 menu" id="menu">
            <li class="nav-item">
                <a class="nav-link <?= is_page_active('/')?>" href="/">Home</a>
            </li>
            <?php if(isset($_SESSION['user_id']) and (in_array($_SESSION['user_role'], array(1,2)))) : ?>
                <?php if(isset($_SESSION['user_id']) and (in_array($_SESSION['user_role'], array(2)))) : ?>

                    <li class="nav-item">
                        <a class="nav-link <?= is_page_active('/users')?>" href="/users">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= is_page_active('/roles')?>" href="/roles">Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= is_page_active('/pages')?>" href="/pages">Pages</a>
                    </li>
                <?php endif; ?>

                <hr>
                <span class="fs-5 d-none d-sm-inline">Categories</span>
                <li class="nav-item">
                    <a class="nav-link <?= is_page_active('/todo/category')?>" href="/todo/category">Todo categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= is_page_active('/todo/tasks')?>" href="/todo/tasks">Todo task list</a>
                </li>
            <?php endif; ?>

        </ul>
        <hr>
</div>


<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark side__menu">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 mt-5">
                    <span class="fs-5 d-none d-sm-inline pb-4">Menu</span>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if(isset($_SESSION['user_id']) and (in_array($_SESSION['user_role'], array(1,2)))) : ?>
                    <?php if(isset($_SESSION['user_id']) and (in_array($_SESSION['user_role'], array(2)))) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= is_page_active('/')?>" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= is_page_active('/users')?>" href="/users">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= is_page_active('/roles')?>" href="/roles">Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= is_page_active('/pages')?>" href="/pages">Pages</a>
                    </li>
                    <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link <?= is_page_active('/')?>" href="/">Home</a>
                        </li>
                    <hr>
                    <span class="fs-5 d-none d-sm-inline">Categories</span>
                    <li class="nav-item">
                        <a class="nav-link <?= is_page_active('/todo/category')?>" href="/todo/category">Todo categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= is_page_active('/todo/tasks')?>" href="/todo/tasks">Todo task list</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <?php
                if(isset($_SESSION['user_id']) and !empty($_SESSION['user_id'])){?>
                <div class="dropdown pb-4 pt-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-circle-user fa-xl" style="color: #ffffff;"></i>
                        <span class="d-none d-sm-inline mx-1"><?=$_COOKIE['user_name']?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="/users/profile">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/auth/logout">Sign out</a></li>
                    </ul>
                </div>
                <?php }else{?>
                    <div class="dropdown pb-4 pt-4">
                        <a href="" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-circle-user fa-xl" style="color: #ffffff;"></i>
                            <span class="d-none d-sm-inline mx-1">Sign in</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="/auth/login">Login</a></li>
                            <li><a class="dropdown-item" href="/auth/register">Register</a></li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col py-3 px-5 mt-5 pb-5">
            <?php echo $content; ?>
        </div>
    </div>
</div>
</body>

<footer class="bg-dark text-center text-white">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: #212529;">
        © 2020 Copyright:
        <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
</footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>


</html>