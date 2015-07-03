<?php
require_once './include/const.php';
require_once OJ_ROOT.'/template/page_start.php'; ?>

<section>
    <div class="container">
        <form method="post" action="register.php" role="form">
            <div class = "col-sm-6">
                <h1>Register</h1>
                <div style='height:20px;clear:both;display:block'></div>
                <h4>"The whole new Adventure."</h4>
                <h4>Welcome to SNG OJ!</h4>
                <div style='height:20px;clear:both;display:block'></div>
                <div id = "ResultText"></div>
            </div>
            <div class = "col-sm-6">
                <div style='height:50px;clear:both;display:block'></div>
                <input type="text" class="form-control" placeholder="Username" name="username" required autofocus/>
                <div style='height:20px;clear:both;display:block'></div>
                <input type="password" class="form-control" placeholder="Password" name="password" required/>
                <div style='height:20px;clear:both;display:block'></div>
                <input type="password" class="form-control" placeholder="Repeat Password" name="passwordre" required/>
                <div style='height:20px;clear:both;display:block'></div>
                <input type="text" class="form-control" placeholder="Email" name="email" required/>
                <div style='height:20px;clear:both;display:block'></div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value = "register">Register</button>
            </div>
        </form>
    </div>
</section>
<?php
if (!empty($_POST['submit'])) {
    $_user = strval($_POST['username']);
    $_pass = strval($_POST['password']);
    $_passr = strval($_POST['passwordre']);
    $_email = strval($_POST['email']);

    $html = '<div class="alert alert-danger" role="alert"><h5>Failed to register</h5>';
    $addCode = '';

    if (strlen($_user) < 5) {
        $html .= '<h6>Username must have at least 5 characters.</h6>';
    } elseif (strlen($_pass) < 5) {
        $html .= '<h6>Password must have at least 5 characters.</h6>';
    } elseif ($_pass != $_passr) {
        $html .= '<h6>Different password when repeat.</h6>';
    } else if (empty($_email) || !ereg("^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$",$_email)) {
        $html .= '<h6>Invaild Email</h6>';
    } else {
        $uid = uc_user_register($_user, $_pass, $_email);
        if($uid <= 0) {
            if($uid == -1) {
                $html .= '<h6>Invaild Username</h6>';
            } elseif($uid == -2) {
                $html .=  '<h6>Username includes invaild words</h6>';
            } elseif($uid == -3) {
                $html .=  '<h6>User already existed</h6>';
            } elseif($uid == -4) {
                $html .=  '<h6>Invaild Email</h6>';
            } elseif($uid == -5) {
                $html .=  '<h6>Email banned</h6>';
            } elseif($uid == -6) {
                $html .=  '<h6>Email already existed</h6>';
            } else {
                $html .=  '<h6>Unknown Error</h6>';
            }
        } else {
            $db->query("INSERT INTO user VALUES (".$uid.",\"".$_user."\",0)");

            $html = '<div class="alert alert-success" role="alert"><h5>Register Succeed</h5><h5><a href = \"login.php\">Login</a></h5>';

        }
    }
    echo "<script>$('#ResultText').html('".$html."</div>');
    $('input[name=username]').val('".$_user."');
    $('input[name=password]').val('".$_pass."');
    $('input[name=passwordre]').val('".$_passr."');
    $('input[name=email]').val('".$_email."');
    ".$addCode."</script>";
}
 ?>
 <script>
     $(document).ready(function(){
         $("#_nav_register").addClass("active");
     })
 </script>
<?php require_once OJ_ROOT.'/template/page_end.php'; ?>
