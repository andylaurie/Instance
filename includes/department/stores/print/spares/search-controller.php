<?php

    // SHOW ERRORS WHILE TESTING...
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    $labels = new Labels();

    // IF SEARCH BUTTON PRESSED...
    if(isset($_GET['search'])) {
        // IF SEARCH TERM IS NOT EMPTY...
        if(!empty($_GET['search'])) {
            // GET SEARCH TERM FOR FIELD...
            $searchTerm = $_GET['search'];
            $rowQty = $labels->searchSparesRows($searchTerm);
            $rowsPerPage = 40;
            include('includes/handlers/paginate-controller.php');
            // RETURN RESULTS...
            $searchTerm = $_GET['search'];
            $result = $labels->searchSpares($searchTerm, $limit, $offset);
        } else {
            // SET ROW QTY TO ZERO IF SEARCH IS BLANK...
            $rowQty = 0;
        }
    }
