<?php
require_once './include/const.php';
require_once OJ_ROOT.'/template/page_start.php'; ?>
<section>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Problem Set</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Source</th>
                        <th>Submit/Accepted</th>
                    </tr>
                </thead>
                <tobdy>
                    <?php
                        $result = $db->query('SELECT problem_id, title, source, submit, accepted FROM problem');
                        while ($row = $db->fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>".$row['problem_id']."</td>";
                            echo "<td><a href=problem.php?pid=".$row['problem_id'].">".$row['title']."</a></td>";
                            echo "<td>".$row['source']."</td>";
                            echo "<td>".$row['submit']." ".$row['accepted']."</td>";
                            echo "</tr>";
                        }
                        $db->free_result($result);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $("#_nav_probset").addClass("active");
    })
</script>
<?php require_once OJ_ROOT.'/template/page_end.php'; ?>
