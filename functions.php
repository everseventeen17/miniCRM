<?php
function is_page_active ($path) {
    $currPath = $_SERVER['REQUEST_URI'];
    return $path === $currPath ? 'active-page' : '';
}