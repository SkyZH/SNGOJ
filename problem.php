<?php
require_once './include/const.php';
require_once OJ_ROOT.'/template/page_start.php'; ?>
<section>
    <div class="container">
        <div class="panel panel-default">
            <?php
                $pid = intval($_GET["pid"]);
                $row = $db->fetch_first("SELECT * FROM problem WHERE problem_id=".$pid);
                echo '<div class="panel-heading">
                Problem '.$row["problem_id"].'</div>';
                echo '<div class="panel-body" style = "text-align: center;">';

                echo ' <div id = "floatR1" class = "col-sm-2 hidden-xs">
                <ul class="nav nav-pills nav-stacked" data-spy="affix" >
                <div id = "floatDiv" style="height: 0px;clear:both;display:block"></div>
                <li role="presentation"><a href="javascript:__scrollTo(\'description\')">Description</a></li>
                <li role="presentation"><a href="javascript:__scrollTo(\'input\')">Input</a></li>
                <li role="presentation"><a href="javascript:__scrollTo(\'output\')">Output</a></li>
                <li role="presentation"><a href="javascript:__scrollTo(\'sample\')">Sample</a></li>
                <li role="presentation"><a href="javascript:__scrollTo(\'hint\')">Hint</a></li>
                <hr/>
                <li role="presentation"><a href="submit.php?pid='.$pid.'">Submit</a></li>
                <li role="presentation"><a href="status.php?pid='.$pid.'">Status</a></li>
                <li role="presentation"><a href="discuss.php?pid='.$pid.'">Discuss</a></li>
                </ul></div>
                <div class = "visible-xs">
                <ul class="nav nav-pills nav-stacked">
                <li role="presentation"><a href="submit.php?pid='.$pid.'">Submit</a></li>
                <li role="presentation"><a href="status.php?pid='.$pid.'">Status</a></li>
                <li role="presentation"><a href="discuss.php?pid='.$pid.'">Discuss</a></li>
                </ul></div>
                ';

                $Prob_Title = $row["title"];

                echo '<div id = "floatR2" class = "col-sm-10"><h1>'.$row["title"].'</h1>';
                echo '<div class="row"><div class = "col-sm-3"><h6>Time Limit: '.$row["time_limit"].' secend(s)</h6></div>';
                echo '<div class = "col-sm-3"><h6>Memory Limit: '.$row["memory_limit"].' MB</h6></div>';
                echo '<div class = "col-sm-3"><h6>Submit/Accepted: '.$row["submit"]."/".$row["accepted"].'</h6></div>';
                echo '<div class = "col-sm-3"><h6>Source: '.$row["source"].'</h6></div></div>';
                echo '<div class="panel-body" style = "text-align: left;">';
                echo '<a name="description" href="javascript:__scrollTo(\'description\')"><br/><br/><h3>Description</h3></a><p>'.$row["description"].'</p>';
                echo '<a name="input" href="javascript:__scrollTo(\'input\')"><br/><br/><h3>Input</h3></a><p>'.$row["input"].'</p>';
                echo '<a name="output" href="javascript:__scrollTo(\'output\')"><br/><br/><h3>Output</h3></a><p>'.$row["output"].'</p>';

                echo '<a name="sample" href="javascript:__scrollTo(\'sample\')"><br/><br/><h3>Sample</h3></a><div class="row">';
                echo '<div class = "col-sm-6"><h4>Input</h4><div class = "panel panel-default"><span class="sampledata">'.$row["sample_input"].'</span></div></div>';
                echo '<div class = "col-sm-6"><h4>Output</h4><div class = "panel panel-default"><span class="sampledata">'.$row["sample_output"].'</span></div></div>';
                echo '</div>';
                echo '<a name="hint" href="javascript:__scrollTo(\'hint\')"><br/><br/><h3>Hint</h3></a><p>'.$row["hint"].'</p>';
                echo '<div class="row">';
                echo '</div></div>';
                echo '</div>';
                $db->free_result($result);
            ?>

        </div>
    </div>
</section>
<script>
function gotoPbSet()
{
    location.href = "problemset.php";
}
</script>
<script>
    $(document).ready(function(){
        $("#_nav_probset").addClass("active");
        $("#submiturl").attr("href","submit.php?pid="+<?php echo $pid?>);
        $("#submiturl").html("Submit <?php echo $pid."|".$Prob_Title ?>");
    })
    function __scrollTo(href) {
        obj = $("a[name="+href+"]");
        window.scrollTo(0, obj.get(0).offsetTop + 100);
    }
</script>
<?php require_once OJ_ROOT.'/template/page_end.php'; ?>
