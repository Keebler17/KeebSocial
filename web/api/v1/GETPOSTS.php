<?php

/**
 * GETPOSTS.php
 * @param user invoker
 * @param key token
 * @param feed
 *  Array of users to get posts from
 * @param index 0=most recent
 * @return JSON if index is set
 *  Fields: {author, date, content, replies: }}
 * @return count if index is not set
 *  Number of posts available in the given feed
 */

require_once getenv("PHP_ROOT") . "/api/helper/USER.php";
require_once getenv("PHP_ROOT") . "/api/helper/USER_AUTH.php";
require_once getenv("PHP_ROOT") . "/api/helper/POST.php";


$data = json_decode(file_get_contents("php://input"));

if(!isset($data->key) || !isset($data->feed) || !isset($data->user)) {
    echo '1';
    exit();
}

if(!checkToken($data->user, $data->key)) {
    echo '30';
    exit();
}

if(!isset($data->index)) {
    echo getPostCount($data->feed);
    exit();
}

$response = getPostByIndex($data->feed, $data->index);

$response->author = getUsername($response->author); // instead of giving the caller the uuid of the author, give them the user handle

echo json_encode($response);