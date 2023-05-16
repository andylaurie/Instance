<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    $labels = new Labels();

    if(!empty($_GET['printPart'])) {
        $pn = $_GET['printPart'];
        $part = $labels->getDescription($pn);
    }
