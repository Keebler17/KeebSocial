<?php

require_once getenv("PHP_ROOT") . "/api/helper/USER_AUTH.php";
$check_authenticated = false;
if(isset($_COOKIE['username']) && isset($_COOKIE['token'])) {
    if(checkToken($_COOKIE['username'], $_COOKIE['token'])) {
        $check_authenticated = true;
    }
}