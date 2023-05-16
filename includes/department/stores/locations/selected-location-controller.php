<?php

    $loc = new Loc();
    if(isset($_GET['sP']) AND isset($_GET['sR'])) {
        $partNumber = $_GET['sP'];
        $rackNumber = $_GET['sR'];
        $result = $loc->getDetails($partNumber, $rackNumber);
    }
