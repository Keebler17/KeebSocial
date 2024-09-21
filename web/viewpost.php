<?php echo file_get_contents(getenv("PHP_ROOT") . "/resources/header.php"); ?>

<?php
    if(!isset($_GET['id'])) {
        header("Location: /");
    }
?>



<div id="posts"></div>
<link rel="stylesheet" href="/resources/user.css">
<link rel="stylesheet" href="/timeline/timeline.css">

<script>
    viewpost();
</script>

<?php echo file_get_contents(getenv("PHP_ROOT") . "/resources/footer.php"); ?>