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
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select name="lang" class="form-control">
                                    <option value = "-1"  selected = "selected">All</option>
                                    <option value = "0">C++</option>
                                    <option value = "1">C</option>
                                    <option value = "2">Python</option>
                                    <option value = "3">Java</option>
                                    <option value = "4">Pascal</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select name="status" class="form-control">
                                    <option value = "-1"  selected = "selected">All</option>
                                    <option value = "0">Accepted</option>
                                    <option value = "1">Wrong Answer</option>
                                    <option value = "2">Memory Limit Excceed</option>
                                    <option value = "3">Time Limit Excceed</option>
                                    <option value = "4">Runtime Error</option>
                                    <option value = "5">Compile Error</option>
                                    <option value = "6">Running</option>
                                    <option value = "7">Pending</option>
                                    <option value = "8">Unknown</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <a href = "status.php" class="btn btn-default">Reset</a>
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="row" id = "alertDiv">
                </div>
                <div class = "row" style="line-height: 30px;">
                    <div class="col-md-2 col-sm-4"><h6>Problem ID</h6></div>
                    <div class="col-md-2 col-sm-4"><h6>User</h6></div>
                    <div class="col-md-2 col-sm-4"><h6>Language</h6></div>
                    <div class="col-md-4 col-sm-4"><h6>Status</h6></div>
                    <div class="col-md-1 col-sm-4"><h6>Time</h6></div>
                    <div class="col-md-1 col-sm-4"><h6>Memory</h6></div>
                </div>

                <?php
                    $__pid = strval($_GET["pid"]);
                    $_user = strval($_GET["user"]);
                    $__lang = strval($_GET["lang"]);
                    $__status = strval($_GET["status"]);
                    $__uid = strval($_GET["uid"]);
                    if($uid == "")
                        if($_user != "") {
                            $__list = uc_get_user($_user);
                            $__uid = strval($__list[0]);
                            if($__uid == "") {
                                $html = '<div class="alert alert-warning" role="alert"><h5>User not found.</h5></div>';
                                echo "<script>
                                    $(document).ready(function(){
                                        $('#alertDiv').html('".$html."');
                                    })
                                </script>";
                            }
                        }

                    $addPara = '';
                    if ($__pid != '') {
                        $addPara .= 'pid='.urlencode($__pid).'&';
                    }
                    if($_user != '') {
                        $addPara .= 'user='.urlencode($_user).'&';
                    }
                    if ($__uid != '') {
                        $addPara .= 'uid='.urlencode($__uid).'&';
                    }
                    if ($__lang != '' && $__lang <> '-1') {
                        $addPara .= 'lang='.urlencode($__lang).'&';
                    }
                    if ($__status != '' && $__status <> '-1') {
                        $addPara .= 'status='.urlencode($__status).'&';
                    }

                    $page = intval($_GET['page']);
                    $startItem = $page * $ITEM_SELECT;
                    $endItem = $startItem + $ITEM_SELECT;

                    $sqlFilter = '';
                    if ($__pid != '' || $__uid != '' || $__lang != '' || $__status != '') {
                        $sqlFilter .= " where ";
                    }
                    $firstFilter = false;
                    if ($__pid != '') {

                        $sqlFilter .= ($firstFilter?" and ":"")." pid = ".$__pid;
                        if(!$firstFilter) $firstFilter = true;
                    }
                    if ($__uid != '') {
                        $sqlFilter .= ($firstFilter?" and ":"")." uid = ".$__uid;
                        if(!$firstFilter) $firstFilter = true;
                    }
                    if ($__lang != '') {
                        $sqlFilter .= ($firstFilter?" and ":"")." lang = ".$__lang;
                        if(!$firstFilter) $firstFilter = true;
                    }
                    if ($__status != '') {
                        $sqlFilter .= ($firstFilter?" and ":"")." status = ".$__status;
                        if(!$firstFilter) $firstFilter = true;
                    }

                    $result = $db->query('SELECT path, uid, pid, lang, status, time, memory FROM judge '.$sqlFilter.'
                    ORDER BY jid DESC LIMIT '.$startItem.', '.$ITEM_SELECT);

                    while ($row = $db->fetch_array($result)) {
                        $__list = uc_get_user($row['uid'], true);
                        $_username = $__list[1];
                        echo "<div class='row' style='line-height: 30px;'>";
                        echo '<a href = "problem.php?pid='.$row['pid'].'"><div class="col-md-2 col-sm-4">'.$row['pid'].'</div></a>
                        <a href = "profile.php?uid='.$row['uid'].'"><div class="col-md-2 col-sm-4">'.$_username.'</div></a>
                        <a href = "viewcode.php?code='.$row['path'].'"><div class="col-md-2 col-sm-4">'.$row['lang'].'</div></a>
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
        echo '<script>
            $(document).ready(function(){
                $("input[name=pid]").val("'.$__pid.'");
                $("input[name=user]").val("'.$_user.'");'.
                ($__lang<>""?'$("select[name=lang]").val("'.$__lang.'");':'').
                ($__status<>""?'$("select[name=status]").val("'.$__status.'");':'').
            '});
        </script>'
    ?>
</section>

<script>
    $(document).ready(function(){
        $("#_nav_status").addClass("active");
    })
</script>
<?php require_once(OJ_ROOT."/template/page_end.php"); ?>
