<?php
require_once getenv("PHP_ROOT") . "/api/helper/USER.php";
require_once getenv("PHP_ROOT") . "/api/helper/DB.php";

$data = json_decode(file_get_contents("php://input"));

if(!isset($data->key) || !isset($data->target)) {
    echo '1';
    exit();
}

if()

?>