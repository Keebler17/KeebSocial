<?php

/**
 * TIMELINE.php
 * Funny little file I've got going on here
 * use include PHP_ROOT/timeline/timeline.php and set the $users variable and itll spit out the correct timeline (i think)
 * idk i might rework this concept another day
 */

$users = [$_COOKIE["username"]];

?>

<link rel="stylesheet" href="/timeline/timeline.css">
<div id="posts">
</div>
<script>
    async function runTimeline() {
        feed = await getFeed();
        initTimeline(feed);
    }
    runTimeline();
</script>