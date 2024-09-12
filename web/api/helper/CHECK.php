<?php
/**
 * CHECK.php
 * DOES NOT WORK IN API
 * Only for dynamically changing HTML
 */
require_once getenv("PHP_ROOT") . "/api/helper/USER_AUTH.php";
$check_authenticated = false;
if(isset($_COOKIE['username']) && isset($_COOKIE['token'])) {
    // if(!(strcmp($_COOKIE['username'], '') == 0) && (strcmp($_COOKIE['token'], '') == 0)) {
        if(checkToken($_COOKIE['username'], $_COOKIE['token'])) {
            $check_authenticated = true;
        }
    // }
}