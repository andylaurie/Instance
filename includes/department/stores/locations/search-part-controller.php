<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    $loc = new Loc();

    if(isset($_GET['search'])) {
        $searchTerm = $_GET['search'];
        $rowQty = $loc->getSearchRows($searchTerm);
        $rowsPerPage = 40;
        $totalPages = ceil($rowQty / $rowsPerPage);

        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $currentPage = (int) $_GET['page'];
        } else {
            $currentPage = 1;
        }

        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }

        if ($currentPage < 1) {
            $currentPage = 1;
        }

        $offset = ($currentPage - 1) * $rowsPerPage;
        $limit = $rowsPerPage;

        $searchTerm = $_GET['search'];
        $result = $loc->searchPartNumber($searchTerm, $limit, $offset);
    }
