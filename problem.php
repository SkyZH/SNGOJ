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
                <a href="problemset.php"><button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
                <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></button></a>
                Problem '.$row["problem_id"].'</div>';
                echo '<div class="panel-body" style = "text-align: center;">';
                echo '<h1>'.$row["title"].'</h1>';
                echo '<div class="row"><div class = "col-sm-3"><h6>Time Limit: '.$row["time_limit"].' secend(s)</h6></div>';
                echo '<div class = "col-sm-3"><h6>Memory Limit: '.$row["memory_limit"].' MB</h6></div>';
                echo '<div class = "col-sm-3"><h6>Submit/Accepted: '.$row["submit"]."/".$row["accepted"].'</h6></div>';
                echo '<div class = "col-sm-3"><h6>Source: '.$row["source"].'</h6></div></div>';
                echo '<div class="panel-body" style = "text-align: left;">';
                echo '<h3>Description</h3><p>'.$row["description"].'</p>';
                echo '<h3>Input</h3><p>'.$row["input"].'</p>';
                echo '<h3>Output</h3><p>'.$row["output"].'</p>';

                echo '<h3>Sample</h3><div class="row">';
                echo '<div class = "col-sm-6"><h4>Input</h4><div class = "panel panel-default"><span class="sampledata">'.$row["sample_input"].'</span></div></div>';
                echo '<div class = "col-sm-6"><h4>Output</h4><div class = "panel panel-default"><span class="sampledata">'.$row["sample_output"].'</span></div></div>';
                echo '</div>';
                echo '<h3>Hint</h3><p>'.$row["hint"].'</p>';
                echo '<div class="row">';
                echo '<a href="submit.php?pid='.$pid.'"><button class="btn btn-lg btn-primary btn-block">Submit</button></a></div>';
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
    })
</script>
<?php require_once OJ_ROOT.'/template/page_end.php'; ?>
