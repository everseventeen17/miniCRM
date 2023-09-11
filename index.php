<?php
session_start();

require 'libraries/carbon/autoload.php';
require_once 'functions.php';
require_once 'config.php';
require_once 'autoload.php';


$router = new \app\Router();
$router->run();