<?php

    $stock = new Stock();

    $rowQty = $stock->getNoLocationRows();
    $rowsPerPage = 40;
    include('includes/handlers/paginate-controller.php');

    $result = $stock->getNoLocation($limit, $offset);
