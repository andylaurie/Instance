<?php

    $loc = new Loc();

    if(isset($_GET['search'])) {
        $searchTerm = $_GET['search'];
        $rowQty = $loc->getSearchRackRows($searchTerm);
        $rowsPerPage = 40;
        include('includes/handlers/paginate-controller.php');

        $searchTerm = $_GET['search'];
        $result = $loc->searchRackNumber($searchTerm, $limit, $offset);
    }
