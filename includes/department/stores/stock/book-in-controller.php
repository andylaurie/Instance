<?php

    $stock = new Stock();

    if(isset($_POST['bookInButton'])) {

        $partNumber = $_POST['partNumber'];
        $boxQty = $_POST['boxQty'];
        $qty = $_POST['qty'];
        $dateRec = $_POST['dateRec'];
        $user = $_SESSION['userLoggedIn'];

        $exists = $stock->checkExists($partNumber);



        if(empty($partNumber)) {
            alert("Please Enter a Part Number");
        } elseif (empty($exists)) {
            alert("Part Number does not exist, please check your spelling");
        } elseif(empty($boxQty)) {
            alert("Please Enter a Box Qty");
        } elseif(empty($qty)) {
            alert("Please Enter a Quantity");
        } else {
            $result = $stock->bookIn($partNumber, $boxQty, $qty, $dateRec, $user);
            if($result == true) {
                $partNumber = $stock->sanitizePartNumber($partNumber);
                $description = $stock->getDescription($partNumber);
                $dateRec = $stock->sanitizeDateRec($dateRec);
                $maxBoxID = $stock->maxBoxID();
                include('book-in-print-controller.php');
                //header("Location: " . BASE_URI) . "stores/stock/book-in";
            }
        }
    }
