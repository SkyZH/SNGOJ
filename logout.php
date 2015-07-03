<?php
require_once './include/const.php';

setcookie('OJ_AUTH', '', -86400);
$_COOKIE["OJ_AUTH"] = "";
if (!empty($_POST['submit'])) {
    echo "<script> location.href = 'login.php'; </script>";
}

require_once OJ_ROOT.'/template/page_start.php'; ?>

<section>
    <div class="container">
        <form method="post" action="logout.php" role="form">
            <div class="col-sm-6">
                <h1>Logout</h1>
                <div style='height:20px;clear:both;display:block'></div>
                <h4>"Goodbye, sir."</h4>
                <h4>Welcome to SNG OJ!</h4>
                <div style='height:20px;clear:both;display:block'></div>
                <div id="ResultText"><div class="alert alert-success" role="alert"><h5>You've been successfully logged out</h5>
                </div></div>
            </div>
            <div class="col-sm-6">
                <div style='height:50px;clear:both;display:block'></div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="login">Login</button>
            </div>
        </form>
    </div>
</section>


<?php require_once OJ_ROOT.'/template/page_end.php'; ?>
