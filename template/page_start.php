<!DOCTYPE html>
<html>

<head>
    <title>SNGOJ</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <link href="main.css" rel="stylesheet">

    <script src="dist/js/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>

</head>

<body>

<?php
require_once(OJ_ROOT."/page/user.php");
require_once(OJ_ROOT."/page/header.php");
$db = new dbstuff;
$db->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
unset($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
?>
