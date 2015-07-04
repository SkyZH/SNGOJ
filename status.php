<?php
require_once("./include/const.php");
require_once(OJ_ROOT."/template/page_start.php");
$ITEM_SELECT = 20;?>

<section>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Problem Set</div>
            <div class="panel-body">
                <form method="get" action="status.php" role="form">
                    <div class="row" style="line-height: 30px;">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Problem ID" name="pid">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username" name="user">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Language" name="lang">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Status" name="status">
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </form>
                <div class = "row" style="line-height: 30px;">
                    <div class="col-md-2 col-sm-4"><h6>Problem ID</h6></div>
                    <div class="col-md-2 col-sm-4"><h6>User</h6></div>
                    <div class="col-md-2 col-sm-4"><h6>Language</h6></div>
                    <div class="col-md-4 col-sm-4"><h6>Status</h6></div>
                    <div class="col-md-1 col-sm-4"><h6>Time</h6></div>
                    <div class="col-md-1 col-sm-4"><h6>Memory</h6></div>
                </div>

                <?php
                    $page = intval($_GET['page']);
                    $startItem = $page * $ITEM_SELECT;
                    $endItem = $startItem + $ITEM_SELECT;

                    $sqlFilter = '';
                    if ($title != '') {
                        $sqlFilter .= " where title like '%".$title."%'";
                    }
                    $result = $db->query('SELECT uid, pid, lang, status, time, memory FROM judge '.$sqlFilter.'
                    ORDER BY jid DESC LIMIT '.$startItem.', '.$ITEM_SELECT);

                    while ($row = $db->fetch_array($result)) {
                        $__list = uc_get_user($row['uid'], true);
                        $_username = $__list[1];
                        echo "<div class='row' style='line-height: 30px;'>";
                        echo '<div class="col-md-2 col-sm-4">'.$row['pid'].'</div>
                        <a href = "profile.php?uid='.$row['uid'].'"><div class="col-md-2 col-sm-4">'.$_username.'</div></a>
                        <div class="col-md-2 col-sm-4">'.$row['lang'].'</div>
                        <div class="col-md-4 col-sm-4">'.$row['status'].'</div>
                        <div class="col-md-1 col-sm-4">'.$row['time'].'</div>
                        <div class="col-md-1 col-sm-4">'.$row['memory'].'</div>';
                        echo "</div>";
                    }
                    $db->free_result($result);
                    $result = $db->query('SELECT count(*) as sum FROM judge '.$sqlFilter);

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
                    if ($startPage < 0 && $endPage >= $maxPage) {
                        $startPage = 0;
                        $endPage = $maxPage - 1;
                    } elseif ($startPage < 0) {
                        $endPage -= $startPage;
                        $startPage = 0;
                    } elseif ($endPage >= $maxPage) {
                        $startPage = $startPage - ($endPage - $maxPage + 1);
                        $endPage = $maxPage - 1;
                    }
                    $db->free_result($result);
                    $addPara = '';
                ?>
                <div class = "row">
                    <div class = "col-xs-12" style = "text-align: center;">
                        <nav>
                            <ul class="pagination">
                                <li <?php echo $PrevPage == true ? '' : "class='disabled'";?>>
                                    <a <?php echo $PrevPage == true ? "href='status.php?".$addPara.'page='.
                                    strval($page - 1)."'" : '';?> aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php
                                    for ($i = intval($startPage); $i <= intval($endPage); ++$i) {
                                        echo '<li '.($i == $page ? "class='active'" : '').
                                        "><a href='status.php?".$addPara.'page='.strval($i)."'>".strval($i + 1).
                                        '</a></li>';
                                    }
                                ?>
                                <li <?php echo $NextPage == true ? '' : "class='disabled'";?>>
                                    <a <?php echo $NextPage == true ? "href='status.php?".$addPara.'page='.
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
    ?>
</section>

<script>
    $(document).ready(function(){
        $("#_nav_status").addClass("active");
    })
</script>
<?php require_once(OJ_ROOT."/template/page_end.php"); ?>
