<?php echo file_get_contents(getenv("PHP_ROOT") . "/resources/header.php"); ?>

<?php
    if(!isset($_GET['name'])) {
        if(isset($_COOKIE['username'])) {
            header("Location: /user.php?name=" . $_COOKIE['username']);
            exit();
        } else {
            header("Location: /");
            exit();
        }
    }
    echo "user page for " . $_GET['name'];
?>

<script src="/resources/user.js"></script>
<link rel="stylesheet" href="/resources/user.css">
<br>
<div id="profile_banner">
    <h1 id="profile_usernsame">Brendan KeebSocial</h1>
    <img id="profile_image" src="https://dummyimage.com/128/128/fff">
    <span id="profile_bio">biobiobiobiobiobiobiobiobiobio</span>
</div>
<?php echo file_get_contents(getenv("PHP_ROOT") . "/resources/footer.php"); ?>