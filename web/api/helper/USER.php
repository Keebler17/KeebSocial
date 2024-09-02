<?php
require_once getenv("PHP_ROOT") . "/api/helper/DB.php";


function setUserField($username, $field, $value) {

}

function getUserField($username, $field) {
    global $keebsocial_content;
    checkUserArguments($username, $field);
    return $keebsocial_content->users->findOne(['username' => $username])->{$field};
}

function pullUserArray($username, $field, $content) {
    global $keebsocial_content;
    checkUserArguments($username, $field);
    $keebsocial_content->users->updateOne(
        ['username' => $username],
        ['$pull' => [
            $field => $content
        ]]
    );
}

function pushUserArray($username, $field, $content) {
    global $keebsocial_content;
    checkUserArguments($username, $field);
    $keebsocial_content->users->updateOne(
        ['username' => $username],
        ['$push' => [
            $field => $content
        ]]
    );
}

function doesUserFollow($username, $target) {

}

function checkUserArguments($username, $field) {
    if(!cUserExists($username)) return 2;
    if(!_isValidUserField($field)) return 1;
    return 0;
}

function addFollow($username, $target) {
    if(cUserExists($username) && cUserExists($target)) {
        
    }
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
        'blocks' => [],
        'keebs_count' => 0,
        'followers_count' => 0,
        'follows_count' => 0,
        'likes_count' => 0,
        'private' => false
    ]);
}

function cUserExists($username) {
    global $keebsocial_content;
    return ($keebsocial_content->users->count(['username' => $username]) == 1);
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

function _isValidUserField($field) {
    global $validUserFields;
    return in_array($field, $validUserFields);
}

