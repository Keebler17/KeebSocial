<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>KeebSocial</title>
        <meta charset="UTF-8">
        <meta property="og:title" content="KeebSocial">
        <meta property="og:description" content="KeebSocial Social Networking Platform -- beta">
        <meta property="og:image" content="/resources/icon.png">
        <link rel="icon" type="image/x-icon" href="/resources/icon.png">
        <link rel="stylesheet" href="/resources/index.css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <script src="/resources/index.js"></script>
    </head>
    <body>
        <div id="header">
          <a href="/" id="homecorner">
            <img src="/resources/keebler.png" id="keeblerlogo">
            <span id="platformname" class="navbarspan">KeebSocial</span>
          </a>
          <a href="/"><span id="home" class="navbarspan navlink">Home</span></a>
          <a href="/about"><span id="about" class="navbarspan navlink">About</span></a>

          <!-- Replace with profile when logged in-->
          <?php
            require_once getenv("PHP_ROOT") . "/api/helper/CHECK.php";
          ?>
          <a href="/login" id="login"><span class="navbarspan">Login</span><a>
          <a href="/user" id="profile"><span class="navbarspan"><img src="https://dummyimage.com/64/64/fff"></a>
        </div>