<?php echo file_get_contents(getenv("PHP_ROOT") . "/resources/header.php"); ?>

<!-- homepage -->

<?php
require_once getenv("PHP_ROOT") . "/api/helper/CHECK.php";

if($check_authenticated) {
    include getenv("PHP_ROOT") . "/timeline/timeline.php";
}

?>

<?php echo file_get_contents(getenv("PHP_ROOT") . "/resources/footer.php"); ?>