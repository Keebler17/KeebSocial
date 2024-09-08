<?php
require_once getenv("PHP_ROOT") . "/api/helper/DB.php";

/**
 * USER.php
 * Utility functions for displaying user info
 */

function getUsername($uuid) {
    global $keebsocial_content;
    $resp = $keebsocial_content->users->findOne(['uuid' => $uuid]);
    return $resp->username;
}

function setUserField($username, $field, $value) {
    global $keebsocial_content;
    checkUserArguments($username, $field);
    $keebsocial_content->users->updateOne(
        ['username' => $username],
        ['$set' =>
            [$field => $value]
        ]
    );
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

function getUserArray($username, $field) {

}

function doesUserFollow($username, $target) {
    global $keebsocial_content;
    return ($keebsocial_content->users->count(["username" => $username, "follows" => getUserField($target, "uuid")]) >= 1);
}

function checkUserArguments($username, $field) {
    if(!cUserExists($username)) return 2;
    if(!_isValidUserField($field)) return 1;
    return 0;
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

function buildUsernameQuery($usernameArr) {
    $usernameQuery = [];
    foreach($usernameArr as $user) {
        array_push($usernameQuery, [
            'author' => getUserField($user, "uuid")
        ]);
    }
    return $usernameQuery;
}

