<?php
require_once getenv("PHP_ROOT") . "/api/helper/USER_AUTH.php";

$args = json_decode(file_get_contents('php://input'));
if(!(isset($args->username) || !isset($args->token))) {
    echo '2';
    exit();
}
$username = $args->username;
$token = $args->token;

echo checkToken($username, $token) ? '0' : '1';