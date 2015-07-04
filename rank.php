<?php
require_once("./include/const.php");
require_once(OJ_ROOT."/template/page_start.php"); ?>

<section>
    <div class="container">
        <div class="jumbotron">
            <h1>SNGOJ</h1>
            <h2>Rank</h2>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $("#_nav_rank").addClass("active");
    })
</script>
<?php require_once(OJ_ROOT."/template/page_end.php"); ?>
