<?php
// PAGE TITLE...
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $user = strtolower($_SESSION['userLoggedIn']);

    if(substr_count($url, '/') == 2) {
        $str = $url . "/home";
    } else {
        $str = $url;
    }

    $str = str_replace('/Instance/', "" ,$str);
    $str = str_replace($currentDepartment . '/', "" ,$str);
    $str = str_replace('-', " ", $str);
    $str = str_replace('/', " - " ,$str);

    echo '<h3>' . ucwords($str) . '</h3>';
