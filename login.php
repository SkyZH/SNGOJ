<?php
require_once './include/const.php';
require_once OJ_ROOT.'/template/page_start.php'; ?>

<section>
    <div class="container">
        <form method="post" action="login.php" role="form">
            <div class="col-sm-6">
                <h1>Login</h1>
                <div style='height:20px;clear:both;display:block'></div>
                <h4>"Enjoy yourself."</h4>
                <h4>Welcome to SNG OJ!</h4>
                <div style='height:20px;clear:both;display:block'></div>
                <div id="ResultText"></div>
            </div>
            <div class="col-sm-6">
                <div style='height:50px;clear:both;display:block'></div>
                <input type="text" class="form-control" placeholder="Username" name="username" required autofocus/>
                <div style='height:20px;clear:both;display:block'></div>
                <input type="password" class="form-control" placeholder="Password" name="password" required/>
                <div style='height:20px;clear:both;display:block'></div>
                <input type="checkbox" name="remember" value="remember" /> Remember Me
                <div style='height:20px;clear:both;display:block'></div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="login">Login</button>
            </div>
        </form>
    </div>
</section>

<?php
if (!empty($_POST['submit'])) {
    $_reme = strval($_POST['remember']);
    $__user = $_user = strval($_POST['username']);
    $__pass = $_pass = strval($_POST['password']);

    $html = '<div class="alert alert-danger" role="alert"><h5>Failed to login</h5>';
    $addCode = '';
    list($uid, $username, $password, $email) = uc_user_login($_user, $_pass);


    setcookie('OJ_AUTH', '', -86400);

    if ($uid > 0) {
        $html = '<div class="alert alert-success" role="alert"><h5>Login Succeed</h5>';
        if (!$db->result_first("SELECT count(*) FROM user WHERE uid='$uid'")) {
            $html = '<div class="alert alert-warning" role="alert">
            <h6>We&apos;ve automatically activated your account in SNG OJ</h6>';
        }
        if ($_reme == 'remember') {
            setcookie('OJ_AUTH', uc_authcode($uid."\t".$username, 'ENCODE'), time() + 86400 * 365);
        } else {
            setcookie('OJ_AUTH', uc_authcode($uid."\t".$username, 'ENCODE'), 0);
        }
        $addCode = "location.href = 'index.php';";
    } elseif ($uid == -1) {
        $html .= "<h6>User doesn&apos;t exist</h6>";
    } elseif ($uid == -2) {
        $html .= '<h6>Wrong Password</h6>';
    } else {
        $html .= '<h6>Unknown Error</h6>';
    }

    echo "<script>$('#ResultText').html('".$html."</div>');
    $('input[name=username]').val('".$__user."');
    $('input[name=password]').val('".$__pass."');
    $('input[name=remember]').attr('checked',".($_reme == 'remember' ? "true" : "false").");
    ".$addCode."</script>";
}
 ?>
 <script>
     $(document).ready(function(){
         $("#_nav_login").addClass("active");
     })
 </script>
<?php require_once OJ_ROOT.'/template/page_end.php'; ?>
