<?php
require_once '/var/composer/vendor/autoload.php';

/**
 * DB.php
 * Sets up database variables and database connection
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new MongoDB\Client("mongodb://db");
$keebsocial_content = $db->keebsocial_content;
$keebsocial_users = $db->keebsocial_users;
?>