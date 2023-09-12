<?php

use Carbon\Carbon;

function is_page_active($path)
{
    $currPath = $_SERVER['REQUEST_URI'];
    return $path === $currPath ? 'active-page' : '';
}

function isAdmin()
{
    return $_SESSION['user_role'] === ADMIN_ROLE ? true : false;
}

function convertDateToMinutes($date)
{
    $date = explode(' ', $date);
    $ydm = explode('-', $date[0]);
    $hms = explode(':', $date[1]);
    $years = $ydm[0] * 12 * 30 * 24 * 60;
    $mounths = $ydm[1] * 30 * 24 * 60;
    $days = $ydm[2] * 24 * 60;
    $ydmResult = $days + $mounths + $years;

    $hours = $hms[0] * 60;
    $minutes = $hms[1];
    $seconds = round(($hms[2] / 60), 1);
    $hmsResult = $hours + $minutes + $seconds;
    return $ydmResult + $hmsResult;
}
function convertMinutesToHumanFormat($date)
{
    if($date <= 60){
        return '00d:' .'00h:' . round(($date), 0) . 'm';
    }
    if($date >= 60 and $date < 1440){
        $hours = round(($date / 60), 0);
        $minutes = round($date - ($hours * 60), 0);
        return '00d:'  . $hours . 'h:' . $minutes .'m';
    }
    if($date >= 1440) {
        $hours = round(($date / 60), 0);
        $minutes = round(($date - (($date / 60) * 60)), 0);
        $days = round(($hours / 24), 0);
        $newHours = $hours - (24*$days);
        return $days . 'd:' . $newHours . 'h:' . $minutes . 'm';
    }
}
