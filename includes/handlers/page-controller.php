<?php

    // GET LOGGED-IN USER DETAILS...
    $account = new Account();
    $currentUser = $_SESSION['userLoggedIn'];
    $userDetails = $account->getUserDetails($currentUser);
    $currentDepartment = $userDetails['department'];
    $currentUserAccess = $userDetails['access'];

    // USER HANDLING...
    if(isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
    }
    else {
        header("Location: " . BASE_URI . "login.php");
    }

    // SEND ALERT...
    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    // GET PAGE TITLE...
    function getPageTitle() {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $user = strtolower($_SESSION['userLoggedIn']);

        if(substr_count($url, '/') == 2) {
            $str = $url . "/home";
        } else {
            $str = $url;
        }

        $str = str_replace('/Instance/', "" ,$str);
        $str = str_replace($GLOBALS['currentDepartment'] . '/', "" ,$str);
        $str = str_replace('-', " ", $str);
        $str = str_replace('/', " - " ,$str);

        echo '<h3>' . ucwords($str) . '</h3>';
    }
