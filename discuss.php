<?php
require_once("./include/const.php");
require_once(OJ_ROOT."/template/page_start.php"); ?>

<section>
    <div class="container">
        <div class="panel panel-default">
        <div class="panel-heading">Discuss</div>
        <div class="panel-body">
            <div class="row" style="line-height: 50px;">
                <div class="col-xs-12">
                    <a href = "newthread.php" class="btn btn-primary">New Thread</a>
                    <a href = "newthread.php" class="btn btn-primary">New Gossip</a>
                </div>
            </div>
            <form method="get" action="discuss.php" role="form">
                <div class="row" style="line-height: 30px;">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Problem ID" name="pid">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="user">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Title" name="title">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <a href = "discuss.php" class="btn btn-default">Reset</a>
                    </div>
                    <div class="col-sm-1">
                        <button class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </form>
            <div class = "row" id = "alertDiv"></div>
            <div class = "row" style="line-height: 30px;">
                <div class="col-md-2 col-xs-2"><h6>Problem ID</h6></div>
                <div class="col-md-3 col-xs-3"><h6>User</h6></div>
                <div class="col-md-5 col-xs-7"><h6>Title</h6></div>
                <div class="col-md-2 hidden-xs hidden-sm"><h6>Time</h6></div>
            </div>
            <?php
                $__pid = strval($_GET["pid"]);
                $_user = strval($_GET["user"]);
                $__title = strval($_GET["title"]);
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
                if ($__title != '') {
                    $addPara .= 'title='.urlencode($__title).'&';
                }
            ?>
        </div>
    </div>
    <?php
        echo '<script>
            $(document).ready(function(){
                $("input[name=pid]").val("'.$__pid.'");
                $("input[name=user]").val("'.$_user.'");
                $("input[name=title]").val("'.$__title.'");
            });
        </script>'
    ?>
</section>

<script>
    $(document).ready(function(){
        $("#_nav_discuss").addClass("active");
    })
</script>
<?php require_once(OJ_ROOT."/template/page_end.php"); ?>
