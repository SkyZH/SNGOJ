<?php
require_once("./include/const.php");
require_once(OJ_ROOT."/template/page_start.php"); ?>

<script type="text/javascript" src="plugin/syntax/scripts/shCore.js"></script>
<script type="text/javascript" src="plugin/syntax/scripts/shBrushCpp.js"></script>
<link type="text/css" rel="stylesheet" href="plugin/syntax/styles/shCoreDefault.css"/>

<section>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Code</div>
            <div class="panel-body">
                <pre class="brush: cpp;"><?php include(OJ_ROOT."/data/prob/".$_GET["code"]);?>
                </pre>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $("#_nav_status").addClass("active");
        SyntaxHighlighter.all();
    })
</script>
<?php require_once(OJ_ROOT."/template/page_end.php"); ?>
