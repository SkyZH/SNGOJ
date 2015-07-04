<?php
require_once './include/const.php';
require_once OJ_ROOT.'/template/page_start.php'; ?>
<?php $PID = strval($_GET['pid']);
if ($PID != '') {
    $AddCodeFront = '<a href="problem.php?pid='.$PID.'"
        <button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
            <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
        </button></a>';
    $AddCode = ' - Problem '.$PID;
} else {
    $AddCodeFront = '';
    $AddCode = ' - Unknown Problem';
}
?>
<?php
if ($_POST['code'] != '') {
    $code = $_POST['code'];
    $_len = strlen($code);
    if ($_len >= 10 && $_len <= 65536) {
        $TargetName = $OJ_UID.'_'.$PID.'_'.time().'_'.rand().'_editor.code';
        if ($fp = fopen($OJ_ROOT.'data/prob/'.$TargetName, 'w')) {
            if (@fwrite($fp, $code)) {
                fclose($fp);
                $db->query("INSERT INTO judge(path, uid, pid, lang, status) VALUES ('".$TargetName."',".$OJ_UID.",".
                $PID.","."0, 0)");
            } else {
                fclose($fp);
            }
        }
    }
} else {
    $_len = -1;
}
if ($_GET['upfile'] != '') {
    $_len = $_FILES['file']['size'];
    if ($_len >= 10 && $_len <= 65536) {
        $TargetName = $OJ_UID.'_'.$PID.'_'.time().'_'.rand().'_'.$_FILES['file']['name'].'.code';
        move_uploaded_file($_FILES['file']['tmp_name'], $OJ_ROOT.'data/prob/'.$TargetName);
        $db->query("INSERT INTO judge(path, uid, pid, lang, status) VALUES ('".$TargetName."',".$OJ_UID.",".
        $PID.","."0, 0)");
    }
}
?>
<section>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $AddCodeFront;?> Submit<?php echo $AddCode;?>
            </div>
            <div class="panel-body">
                <div class = "row">
                    <div class = "col-sm-3">
                        <h3>Language/Compiler</h3>
                        <ul class="nav nav-pills nav-stacked">
                            <li role="presentation" class="active langselect lang_c"><a href="javascript:">C++</a></li>
                            <li role="presentation" class="langselect lang_c"><a href="javascript:">C</a></li>
                            <li role="presentation" class="langselect lang_c"><a href="javascript:">gcc</a></li>
                            <li role="presentation" class="langselect lang_c"><a href="javascript:">g++</a></li>
                            <li role="presentation" class="langselect lang_py"><a href="javascript:">Python</a></li>
                            <li role="presentation" class="langselect lang_ja"><a href="javascript:">Java</a></li>
                        </ul>
                        <hr/>
                        <div>
                            <?php if ($PID == '') {
                                echo '<div class="alert alert-warning" role="alert">
                                <h5>You haven&apos;t chose a problem!</h5>
                                <h6>Please go back to the problem and click submit on the sidebar.</h6>
                                <h6><a href="problemset.php" class="alert-link">Goto Problems</a></h6></div>';
                                echo '<hr/>';
                            }
                            if ($_len != -1) {
                                if ($_len < 10) {
                                    echo '<div class="alert alert-danger" role="alert">
                                    <h5>Code too short!</h5>
                                    <h6>Your code must have at least 10 bytes.</h6></div>';
                                    echo '<hr/>';
                                } elseif ($_len > 65536) {
                                    echo '<div class="alert alert-danger" role="alert">
                                    <h5>Code too long!</h5>
                                    <h6>Your code mustn&apos;t be more than 64K.</h6>
                                    <h6>Use upload instead.</h6></div>';
                                    echo '<hr/>';
                                } else {
                                    echo '<div class="alert alert-success" role="alert">
                                    <h5>Submit succeed!</h5>
                                    <h6><a href="status.php?pid="'.$PID.' class="alert-link">Goto Status</a></h6></div>';
                                }
                            }
                            ?>
                        </div>
                        <ul class="nav nav-pills nav-stacked">
                            <li role="presentation"
                            <?php if ($PID == '') {
                                echo "class='disabled'";
                            }?>><a <?php if ($PID != '') {
                                echo 'href="javascript:submitFile()"';
                            }?>>Submit</a></li>
                            <li role="presentation"><a href="javascript:resetEditor()">Reset</a></li>
                        </ul>
                    </div>
                    <div class = "col-sm-9" style = "height: 600px;">
                        <ul class="nav nav-tabs">
                            <li id="navEditor" role="presentation" class="active navbarselect"><a href="javascript:toEditor()">Editor</a></li>
                            <li id="navUpload" role="presentation" class="navbarselect"><a href="javascript:toUpload()">Upload</a></li>
                        </ul>
                        <div id="editor-container"><pre id="editor">//Put your code here!</pre></div>

                        <div id="upload-container" style = "width: 100%; display: none;">
                            <h3>Select File</h3>
                            <form id = "virtualFormUpload"
                                action="submit.php?upfile=file&pid=<?php echo $PID ?>"
                                method="post" enctype="multipart/form-data" role="form">
                                <input type="file" name="file" id="fileUpload"/>
                            </form>
                        </div>

                    </div>
                </div>
                <form style = "display:none" id = "virtualForm" method="post" action="submit.php?pid=<?php echo $PID ?>" role="form">
                    <textarea name = "code"></textarea>
                </form>



                <script src="./plugin/ace/ace.js" type="text/javascript" charset="utf-8"></script>
                <script>
                    $(document).ready(function(){
                        editor = ace.edit("editor");
                        editor.setTheme("ace/theme/clouds");
                        editor.getSession().setMode("ace/mode/c_cpp");
                    })

                    function toEditor(){
                        $("#upload-container").hide();
                        $("#editor-container").show();
                        $(".navbarselect").removeClass("active");
                        $("#navEditor").addClass("active");
                    }
                    function toUpload(){
                        $("#upload-container").show();
                        $("#editor-container").hide();
                        $(".navbarselect").removeClass("active");
                        $("#navUpload").addClass("active");
                    }
                    var editor;
                    function resetEditor(){
                        editor.setValue("");
                    }

                    $(".langselect").click(function(){
                        $(".langselect").removeClass("active");
                        $(this).addClass("active");
                        if($(this).hasClass("lang_c"))editor.getSession().setMode("ace/mode/c_cpp");
                        if($(this).hasClass("lang_py"))editor.getSession().setMode("ace/mode/python");
                        if($(this).hasClass("lang_ja"))editor.getSession().setMode("ace/mode/java");

                    });

                    function submitFile(){
                        if($("#navUpload").hasClass("active")) {
                            $("#virtualFormUpload").get(0).submit();
                        } else {
                            $("textarea[name=code]").val(editor.getValue());
                            $("#virtualForm").get(0).submit();
                        }

                    }
                </script>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $("#_nav_submit").addClass("active");
    })
</script>
<?php require_once OJ_ROOT.'/template/page_end.php'; ?>
