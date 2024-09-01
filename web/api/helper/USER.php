<?php
require_once getenv("PHP_ROOT") . "/api/helper/DB.php";


function setUserField($username, $field, $value) {

}

function getUserField($username, $field) {
    if(!cUserExists($username)) return 1;
    if(!_isValidUserField($field)) return 0;
    return $keebsocial_content->users->findOne(['username' => $username])->{$field};
}

function getUserArray($username, $field) {

}

function initializeUser($username, $name) {
    global $keebsocial_content;

    $keebsocial_content->users->insertOne([
        'username' => $username,
        'name' => $name,
        'uuid' => uniqid(),
        'date' => time(),
        'bio' => 'KeebSocial User',
        'keebs' => [],
        'followers' => [],
        'follows' => [],
        'likes' => [],
        'keebs_count' => 0,
        'followers_count' => 0,
        'follows_count' => 0,
        'likes_count' => 0,
        'private' => false
    ]);
}

function cUserExists($username) {
    return ($keebsocial_content->users->count(['username' => $username]) == 1);
}

function _isValidUserField($field) {
    return in_array($field, $validUserFields);
}

$validUserFields = [
    "username",
    "name",
    "uuid",
    "date",
    "bio",
    "keebs_count",
    "followers_count",
    "follows_count",
    "likes_count",
    "private"
];

$validUserArrays = [
    "keebs",
    "followers",
    "follows",
    "likes"
];