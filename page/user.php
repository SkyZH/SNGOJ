<?php
if(!empty($_COOKIE['OJ_AUTH'])) {
    list($OJ_UID, $OJ_Username) = explode("\t", uc_authcode($_COOKIE['OJ_AUTH'], 'DECODE'));
} else {
    $OJ_UID = $OJ_Username = "";
}?>
