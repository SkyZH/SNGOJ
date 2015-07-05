<?php
require_once("./include/const.php");
require_once(OJ_ROOT."/template/page_start.php"); ?>

<script src="//cdn.bootcss.com/SyntaxHighlighter/3.0.83/scripts/shCore.min.js"></script>
<script src="//cdn.bootcss.com/SyntaxHighlighter/3.0.83/scripts/shBrushCpp.min.js"></script>
<script src="//cdn.bootcss.com/SyntaxHighlighter/3.0.83/scripts/shBrushJava.min.js"></script>
<script src="//cdn.bootcss.com/SyntaxHighlighter/3.0.83/scripts/shBrushPerl.min.js"></script>
<script src="//cdn.bootcss.com/SyntaxHighlighter/3.0.83/scripts/shBrushRuby.js"></script>
<script src="//cdn.bootcss.com/SyntaxHighlighter/3.0.83/scripts/shBrushPython.min.js"></script>

<link href="//cdn.bootcss.com/SyntaxHighlighter/3.0.83/styles/shCore.min.css" rel="stylesheet">

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
