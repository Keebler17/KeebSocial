<?php

require_once getenv("PHP_ROOT") . "/api/helper/USER_AUTH.php";

if(!userExists("brendanjconnelly")) {
    echo "Creating user<br>";
    createUser("brendanjconnelly", "brendanjconnelly17@gmail.com", "keebler");
}

echo "Generating token: ";
$token = getNewToken("brendanjconnelly", "keebler");
echo $token;
echo "<br>Authenticating token: ";
echo checkToken("brendanjconnelly", $token) ? 'true' : 'false';
echo "<br>Clearing tokens (should be false): ";
clearTokens("brendanjconnelly");
echo checkToken("brendanjconnelly", $token) ? 'true' : 'false';
echo '<br>Reached end of execution.\n';
