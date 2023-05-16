<?php

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
