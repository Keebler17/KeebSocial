<?php

/**
 * TIMELINE.php
 * Funny little file I've got going on here
 * use include PHP_ROOT/timeline/timeline.php and set the $users variable and itll spit out the correct timeline (i think)
 * idk i might rework this concept another day
 */

$users = [$_COOKIE["username"]];


?>

<div id="timeline">
    <div class="post"></div>
</div>
<script>
    initTimeline();
</script>