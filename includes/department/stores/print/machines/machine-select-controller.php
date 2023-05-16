<?php

    $labels = new Labels();

    $rowQty = $labels->listModelRows();
    $rowsPerPage = 40;
    include('includes/handlers/paginate-controller.php');

    $result = $labels->listModels($limit, $offset);
