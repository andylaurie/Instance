<?php

    $labels = new Labels();
    if(isset($_GET['modelNumber'])) {
        $mn = $_GET['modelNumber'];
        $result = $labels->getMachineDetails($mn);
    }
