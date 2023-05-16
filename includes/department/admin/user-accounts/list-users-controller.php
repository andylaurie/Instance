<?php

    $account = new Account();

    $rowQty = $account->listUsersRows();
    $rowsPerPage = 40;
    include('includes/handlers/paginate-controller.php');

    $result = $account->listUsers($limit, $offset);
