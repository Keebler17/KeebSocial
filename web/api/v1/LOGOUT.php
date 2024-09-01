<?php

require_once getenv("PHP_ROOT") . "/api/helper/USER_AUTH.php";
$data = json_decode(file_get_contents("php://input"));

if(isset($data->username) && isset($data->token)) {
    deleteToken($username, $token);
}

?>