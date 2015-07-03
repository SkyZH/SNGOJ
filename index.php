<?php
require_once("./include/const.php");
require_once(OJ_ROOT."/template/page_start.php"); ?>

<section>
    <div class="container">
        <div class="jumbotron">
            <h1>SNGOJ</h1>
            <h2>cout &lt&lt "Hello, OJ!"&lt&lt endl; </h2>
            <p>SNGOJ enables you to practise programming online.</p>
            <p><a class="btn btn-primary btn-lg" href="problem.php?pid=1000" role="button">Get Started</a></p>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $("#_nav_home").addClass("active");
    })
</script>
<?php require_once(OJ_ROOT."/template/page_end.php"); ?>
