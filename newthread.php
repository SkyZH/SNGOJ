<?php
require_once("./include/const.php");
require_once(OJ_ROOT."/template/page_start.php"); ?>

<section>
    <div class="container">
        <div class="panel panel-default">
        <div class="panel-heading">New Thread</div>
        <div class="panel-body">
            <form method="get" action="discuss.php" role="form">
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
                                <input type="text" class="form-control" placeholder="Problem ID">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Title">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" style = "height: 300px;">
                        <pre id="editor"># What you want to say</pre>
                    </div>
                    <textarea name = "code" style="display: none;"></textarea>
                </div>
                <div style='height:20px;clear:both;display:block'></div>
                <div class="row">
                    <div class="col-sm-6">
                        <a href = "newthread.php" class="btn btn-default btn-block btn-lg">Reset</a>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary btn-block btn-lg" type="submit">Submit</button>
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
    })
</script>
<?php require_once(OJ_ROOT."/template/page_end.php"); ?>
