<?php

    // SHOW ERRORS WHILE TESTING...
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    $pickData = new PickData();

    // GET NUMBER OF ROWS...
    $rowQty = $pickData->listModelRows();
    // SET NUMBER OF ROWS PER PAGE...
    $rowsPerPage = 30;
    // CALCULATE NUMBER OF PAGES (ROUNDED UP)...
    $totalPages = ceil($rowQty / $rowsPerPage);
    // SET CURRENT PAGE IF SELECTED...
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $currentPage = (int) $_GET['page'];
    } else {
        $currentPage = 1;
    }
    // RESTRICT PAGES SELECTION...
    if ($currentPage > $totalPages) {
        $currentPage = $totalPages;
    }
    if ($currentPage < 1) {
        $currentPage = 1;
    }
    // CALCULATE PAGE OFFSET AND LIMIT RESULTS...
    $offset = ($currentPage - 1) * $rowsPerPage;
    $limit = $rowsPerPage;
    // RETURN RESULTS...
    $result = $pickData->listModels($limit, $offset);
