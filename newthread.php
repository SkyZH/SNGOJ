<?php
require_once("./include/const.php");
require_once(OJ_ROOT."/template/page_start.php"); ?>

<?php
$__code = strval($_POST["code"]);
$__pid = strval($_REQUEST["pid"]);
$__title = strval($_POST["title"]);

$alertHtml = "";
if($_POST["submit"] <> ""){
    $__code = sql_check_input($__code);
    $__pid = sql_check_input($__pid);
    $__title = sql_check_input($__title);

    if($__pid=="") {
        $alertHtml .= '<div class="alert alert-danger" role="alert"><h5>You must specify a problem id.</h5></div>';
    } elseif(strlen($__title) < 5) {
        $alertHtml .= '<div class="alert alert-danger" role="alert"><h5>Title must have at least 5 characters.</h5></div>';
    } elseif(strlen($__code) < 5) {
        $alertHtml .= '<div class="alert alert-danger" role="alert"><h5>Code must have at least 5 characters.</h5></div>';
    } else {
        $__targetCode = $__code;
        $db->query("INSERT INTO discuss(pid, uid, title, code, submittime) VALUES ({$__pid},{$OJ_UID},
        '{$__title}', '{$__targetCode}',now())");
        $alertHtml .= "<div class=\"alert alert-success\" role=\"alert\"><h5>Post Succeed!</h5><h6><a
        href = 'discuss.php?pid={$__pid}'>Back to discuss</a></h6></div>";
    }
}

 ?>

<section>
    <div class="container">
        <div class="panel panel-default">
        <div class="panel-heading">New Thread</div>
        <div class="panel-body">

            <div id = "alertDiv"><?php echo $alertHtml; ?>
            </div>
            <form method="post" action="newthread.php" role="form" onsubmit="doSubmit()">
                <div class="row" style="line-height: 30px;">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Type<span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Problem</a></li>
                                        <li><a href="#">Gossip</a></li>
                                    </ul>
                                </div><!-- /btn-group -->
                                <input type="text" class="form-control" placeholder="Problem ID" name="pid">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Title" name="title">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" style = "height: 300px;">
                        <pre id="editor"><?php echo ($__code <> "")?$__code:"# What you want to say" ?></pre>
                    </div>
                    <textarea name = "code" style="display: none;" name="text"></textarea>
                </div>
                <div style='height:20px;clear:both;display:block'></div>
                <div class="row">
                    <div class="col-sm-6">
                        <a href = "newthread.php?pid=<?php echo $__pid;?>" class="btn btn-default btn-block btn-lg">Reset</a>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary btn-block btn-lg" type="submit" name="submit" value="newthread">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script src="./plugin/ace/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    $(document).ready(function(){
        $("#_nav_discuss").addClass("active");
        editor = ace.edit("editor");
        editor.setTheme("ace/theme/tomorrow");
        editor.getSession().setMode("ace/mode/markdown");

        $("input[name=pid]").val("<?php echo $__pid;?>");
        $("input[name=title]").val("<?php echo $__title;?>");
    })
    function doSubmit() {
        $("textarea[name=code]").val(editor.getValue());
    }
</script>
<?php require_once(OJ_ROOT."/template/page_end.php"); ?>
