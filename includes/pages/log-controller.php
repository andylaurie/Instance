<?php

    $log = new Log();

    $rowQty = $log->getRows();
    $rowsPerPage = 40;
    include('includes/handlers/paginate-controller.php');

    $result = $log->getLog($limit, $offset);
