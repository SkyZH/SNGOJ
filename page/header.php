<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">SNG OJ</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li id="_nav_home"><a href="index.php">Home</a></li>
                <li id="_nav_probset"><a href="problemset.php">Problems</a></li>
                <li id="_nav_submit"><a id="submiturl" href="submit.php">Submit</a></li>
            </ul>
            <ul id="RightNav" class="nav navbar-nav navbar-right">
                <?php
                if ($OJ_Username == '') {
                    echo '<li id="_nav_register"><a href="register.php">Register</a></li><li id="_nav_login"><a href="login.php">Login</a></li>';
                } else {
                    echo '<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <img width = "16px" height = "16px" src='.UC_API.'/avatar.php?uid='.$OJ_UID.'&size=small>  '.$OJ_Username.'
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="#">Help</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
