<?php

    $stock = new Stock();

    if(isset($_GET['search'])) {
        $partNumber = $_GET['search'];
        $rowQty = $stock->getSearchRows($partNumber);
        $rowsPerPage = 40;
        include('includes/handlers/paginate-controller.php');

        $searchTerm = $_GET['search'];
        $result = $stock->search($searchTerm, $limit, $offset);
    }
