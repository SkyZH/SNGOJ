<?php
require_once './include/const.php';
require_once OJ_ROOT.'/template/page_start.php';
$ITEM_SELECT = 20;?>


<section>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Problem Set</div>
            <div class="panel-body">
                <div class="row" style="line-height: 30px;">
                    <form method="get" action="problemset.php" role="form">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <div class="input-group">
                            <input type="text" class="form-control" placeholder="Title" name="title">

                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </button>
                            </span>
                            </div>
                            </div>
                        </div>
                    </form>
                    <form method="get" action="problem.php" role="form">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Problem ID" name="pid">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class = "row" style="line-height: 30px;">
                    <div class="col-md-2 col-xs-4"><h6>ID</h6></div>
                    <div class="col-md-4 col-xs-8"><h6>Title</h6></div>
                    <div class="col-md-3 hidden-sm hidden-xs"><h6>Source</h6></div>
                    <div class="col-md-3 hidden-sm hidden-xs"><h6>Submit/Accepted</h6></div>
                </div>

                <?php
                    $title = strval($_GET['title']);
                    $page = intval($_GET['page']);
                    $startItem = $page * $ITEM_SELECT;
                    $endItem = $startItem + $ITEM_SELECT;

                    $sqlFilter = '';

                    $title = sql_check_input($title);

                    if ($title != '') {
                        $sqlFilter .= " where title like '%".$title."%'";
                    }
                    $result = $db->query('SELECT problem_id, title, source, submit, accepted FROM problem '.$sqlFilter.' LIMIT '.
                    $startItem.','.$ITEM_SELECT);

                    while ($row = $db->fetch_array($result)) {
                        echo "<div class='row' style='line-height: 30px;'>";
                        echo '<div class="col-md-2 col-xs-4">'.$row['problem_id'].'</div>';
                        echo '<div class="col-md-4 col-xs-8">
                        <a href=\'problem.php?pid='.$row['problem_id']."'>".$row['title'].'</a></div>';
                        echo '<div class="col-md-3 hidden-sm hidden-xs">'.$row['source'].'</div>';
                        echo '<div class="col-md-3 hidden-sm hidden-xs">'.$row['submit'].' '.$row['accepted'].'</div>';
                        echo '</div>';
                    }
                    $db->free_result($result);
                    $result = $db->query('SELECT count(*) as sum FROM problem '.$sqlFilter);

                    $row = $db->fetch_array($result);
                    $All_Item = $row['sum'];
                    $maxPage = intval(ceil($All_Item / $ITEM_SELECT));
                    if ($endItem >= $All_Item) {
                        $NextPage = false;
                    } else {
                        $NextPage = true;
                    }
                    if ($startItem <= 0) {
                        $PrevPage = false;
                    } else {
                        $PrevPage = true;
                    }
                    $startPage = $page - 4;
                    $endPage = $page + 4;
                    list($startPage, $endPage) = get_page_range($startPage, $endPage, $maxPage);

                    $db->free_result($result);
                    $addPara = '';
                    if ($title != '') {
                        $addPara .= 'title='.urlencode($title).'&';
                    }
                ?>
                <div class = "row">
                    <div class = "col-xs-12" style = "text-align: center;">
                        <nav>
                            <ul class="pagination">
                                <li <?php echo $PrevPage == true ? '' : "class='disabled'";?>>
                                    <a <?php echo $PrevPage == true ? "href='problemset.php?".$addPara.'page='.
                                    strval($page - 1)."'" : '';?> aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php
                                    for ($i = intval($startPage); $i <= intval($endPage); ++$i) {
                                        echo '<li '.($i == $page ? "class='active'" : '').
                                        "><a href='problemset.php?".$addPara.'page='.strval($i)."'>".strval($i + 1).
                                        '</a></li>';
                                    }
                                ?>
                                <li <?php echo $NextPage == true ? '' : "class='disabled'";?>>
                                    <a <?php echo $NextPage == true ? "href='problemset.php?".$addPara.'page='.
                                    strval($page + 1)."'" : '';?> aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        echo '<script>
            $(document).ready(function(){
                $("input[name=title]").val("'.$title.'");
            });
        </script>'
    ?>
</section>
<script>
    $(document).ready(function(){
        $("#_nav_probset").addClass("active");
    })
</script>
<?php require_once OJ_ROOT.'/template/page_end.php'; ?>
