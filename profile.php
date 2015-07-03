<?php
require_once("./include/const.php");
require_once(OJ_ROOT."/template/page_start.php"); ?>

<section>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Profile</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <?php
                        echo '<img width="100%" src='.UC_API.'/avatar.php?uid='.$OJ_UID.'&size=big/>'
                        ?>
                    </div>
                    <div class="col-sm-8">
                        <?php list($_uid, $_username, $_email) = uc_get_user($OJ_Username); ?>
                        <h2><?php echo $_username;?></h2>
                        <h5><?php echo $_email;?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once(OJ_ROOT."/template/page_end.php"); ?>
