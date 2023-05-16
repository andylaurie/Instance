<?php
// OPEN SESSION...
    ob_start();
    session_start();

// SET BASE PATH...
    define('BASE_URI', '/Instance/');

// SET URIS...
    $uriAll = $_SERVER['REQUEST_URI'];
    $uriPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uriQuery = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

// LOAD CONFIG...
    include('site/config.php');

// PASS VARS TO JS...
    echo("<script> var svrAdd = '". SVR_ADD. "'; </script>");

// AUTOLOAD CLASSES...
    spl_autoload_register(function ($class_name)
        {
            include 'classes/' . $class_name . '.php';
        }
    );
