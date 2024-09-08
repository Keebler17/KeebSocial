<?php

/**
 * TESTER.php
 * Doesn't actually implement API. Just to test new functions.
 */

require_once getenv("PHP_ROOT") . "/api/helper/USER_AUTH.php";
require_once getenv("PHP_ROOT") . "/api/helper/USER.php";
require_once getenv("PHP_ROOT") . "/api/helper/POST.php";

// echo createPost("test", "This is the first Keeb on KeebSocial");
// echo "<pre>";
// $aaa = getPostByIndex(["test"], 0);
// foreach($aaa as $post) {
//     var_dump($post);
// }
// echo "</pre>";

setUserField("test", "followers_count", 0);