<?php
require_once("./include/const.php");
require_once(OJ_ROOT."/template/page_start.php"); ?>
<?php $PID = strval($_GET["pid"]);
if($PID <> "") {
    $AddCodeFront = '<a href="problem.php?pid='.$PID.'"
        <button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
            <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
        </button></a>';
    $AddCode = " - Problem ".$PID;
}
else {
    $AddCodeFront = "";
    $AddCode = " - Unknown Problem";
}
?>
<section>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $AddCodeFront;?>Submit<?php echo $AddCode;?>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li id="navEditor" role="presentation" class="active navbarselect"><a href="javascript:toEditor()">Editor</a></li>
                    <li id="navUpload" role="presentation" class="navbarselect"><a href="javascript:toUpload()">Upload</a></li>
                </ul>
                <div id="editor-container">
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
                            <div style='height:200px;clear:both;display:block'>
                                <?php if($PID=="") {
                                    echo '<div class="alert alert-warning" role="alert">
                                    <h5>You haven&apos;t chose a problem!</h5>
                                    <h6>Please go back to the problem and click submit at the bottom.</h6>
                                    <h6><a href="problemset.php" class="alert-link">Goto Problems</a></h6></div>';
                                }?>
                            </div>
                            <ul class="nav nav-pills nav-stacked">
                                <li role="presentation"><a href="#">Upload</a></li>
                                <li role="presentation"><a href="javascript:resetEditor()">Reset</a></li>
                            </ul>
                        </div>
                        <div class = "col-sm-9" style = "height: 600px;">
                            <pre id="editor">//Put your code there!</pre>
                        </div>
                    </div>
                </div>
                <div id="upload-container" style = "width: 100%; display: none;">
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value = "upload">Upload</button>
                </div>
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
<?php require_once(OJ_ROOT."/template/page_end.php"); ?>
