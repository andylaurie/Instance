<?php

    $stock = new Stock();

    if(isset($_POST['boxID'])) {
        $boxID = $_POST['boxID'];
        $details = $stock->getDetails($boxID);
        foreach($details as $row) {
            $partNumber = $row['partNumber'];
            $description = $row['description'];
            $boxQty = $row['boxQty'];
            $user = $_SESSION['userLoggedIn'];
        }
        $result = $stock->bookOut($partNumber, $boxID, $boxQty, $user);
        if($result == true) {
            header("Location: " . BASE_URI) . "stores/stock";
        }
    }
