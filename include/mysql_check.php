<?php

function sql_check_input($value) {
    if (get_magic_quotes_gpc()) {
        $value = stripslashes($value);
    }
    if (!is_numeric($value)) {
        $value = mysql_real_escape_string($value);
    }

    return $value;
}

function get_page_range($startPage, $endPage, $maxPage) {
    if ($startPage < 0 && $endPage >= $maxPage) {
        $startPage = 0;
        $endPage = $maxPage - 1;
    } elseif ($startPage < 0) {
        $endPage -= $startPage;
        $startPage = 0;
    } elseif ($endPage >= $maxPage) {
        $startPage = $startPage - ($endPage - $maxPage + 1);
        $endPage = $maxPage - 1;
    }
    if($startPage < 0)$startPage = 0;
    if($endPage >= $maxPage)$endPage = $maxPage - 1;
    return array($startPage, $endPage);
}
