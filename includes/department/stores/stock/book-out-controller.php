<?php

    $stock = new Stock();

    if(isset($_GET['boxID'])) {
        $boxID = $_GET['boxID'];
        $details = $stock->getDetails($boxID);
        foreach($details as $row) {
            $partNumber = $row['partNumber'];
            $description = $row['description'];
            $boxQty = $row['boxQty'];
        }
    }
