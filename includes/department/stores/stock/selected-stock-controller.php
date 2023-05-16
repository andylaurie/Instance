<?php

    $stock = new Stock();
    if(isset($_GET['boxID'])) {
        $boxID = $_GET['boxID'];
        $result = $stock->getDetails($boxID);
    }
