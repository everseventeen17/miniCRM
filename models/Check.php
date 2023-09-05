<?php

namespace models;

use models\Database;
use models\pages\PageModel;

class Check
{
    private $userRole;

    public function __construct($userRole)
    {
        $this->userRole = $userRole;
    }

    public function getCurrentUrlSlug()
    {
        $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parsedUrl = parse_url($url);
        $path = $parsedUrl['path'];
        $pathWithoutBase = str_replace('', '', $path);
        $segments = explode('/', ltrim($pathWithoutBase, '/'));
        $firstTwoSegments = array_slice($segments, 0, 2);
        $url = implode('/', $firstTwoSegments);
        return $url;
    }

    public function checkPermission($url)
    {
        $pageModel = new PageModel();
        $page = $pageModel->getByUrl($url);
        $rolesArray = explode(',', $page['role']);
        if (!$page) {
            return false;
        }
        if (isset($_SESSION['user_role']) and in_array($_SESSION['user_role'], $rolesArray)) {
            return true;
        } else {
            return false;
        }
    }

    public function requirePermission()
    {
        $url = $this->getCurrentUrlSlug();

        if (!$this->checkPermission($url)) {
            header("Location: /");
            return;
        }
    }

    public function isCurrentUserRole($role)
    {
        return $this->userRole == $role ;

    }


}