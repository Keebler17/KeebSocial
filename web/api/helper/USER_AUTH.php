<?php
require_once getenv("PHP_ROOT") . "/api/helper/DB.php";

/**
 * Checks if a username is registered
 * @return boolean Whether or not user is created
 */
function userExists($username) {
    global $keebsocial_users;
    $result = $keebsocial_users->users->count(['username' => "$username"]);
    return ($result == 1); // Returns true if the user does exists
}

/**
 * Creates a user
 * @return JSON UUID and authentication token
 */
function createUser($username, $password) {
    global $keebsocial_users;
    global $keebsocial_content;

}

/** 
 * Checks password
 * @return String Authentication token if valid password, else empty str
*/
function getToken($username, $password) {
    return '';
}

/**
 * Hashes password
 * @return String Hashed, salted password to be stored verbatim
 */
function ksHash($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

/**
 * @return string 64-bit cryptographically secure pseudorandom number
 */
function genToken() {
    return bin2hex(random_bytes(16));
}