<?php

    $labels = new Labels();
    if(isset($_GET['partNumber'])) {
        $pn = $_GET['partNumber'];
        $result = $labels->getDescription($pn);
    }
