<?php
require_once("./include/const.php");
require_once(OJ_ROOT."/template/page_start.php"); ?>

<script src="//cdn.bootcss.com/markdown.js/0.5.0/markdown.min.js"></script>

<?php
    $did = sql_check_input($_GET["did"]);
    $row = $db->fetch_first("SELECT * FROM discuss WHERE did = {$did}");
 ?>
<section>
    <div class="container">
        <div class="panel panel-default">
        <div class="panel-heading">Thread - <?php echo $row["title"]; ?></div>
        <div class="panel-body">

            <div class="row">
                <div class = "col-xs-12">
                    <div class="media">
                        <div class="media-left">
                            <?php echo '<img class = "media-object"
                            src='.UC_API.'/avatar.php?uid='.$OJ_UID.'&size=big/>';
                            ?>
                        </div>
                        <div class="media-body">
                            <div class = "markdowncontent"><?php echo $row["code"]; ?></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<?php $db->free_result($row); ?>
<script>
    $(document).ready(function(){
        $("#_nav_discuss").addClass("active");
        $(".markdowncontent").each(function(){
            $(this).html(markdown.toHTML($(this).html()));
        });
    })
</script>
<?php require_once(OJ_ROOT."/template/page_end.php"); ?>
