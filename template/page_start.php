<!DOCTYPE html>
<html>

<head>
    <title>SNGOJ</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" rel="stylesheet">

    <link href="main.css" rel="stylesheet">

    <script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</head>

<body>

<?php
require_once(OJ_ROOT."/page/user.php");
require_once(OJ_ROOT."/page/header.php");
$db = new dbstuff;
$db->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
unset($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
?>
