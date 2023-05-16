<?php

    if(isset($_POST['stockUpdateButton'])) {

        $partNumber = $_POST['partNumber'];
        $boxQty = $_POST['boxQty'];
        $rackNumber = $_POST['rackNumber'];
        $dateRec = $_POST['dateRec'];
        $boxID = $_POST['boxID'];
        $user = $_SESSION['userLoggedIn'];

        if(empty($rackNumber)) {
            $rackNumber = NULL;
        }
        if(empty($partNumber)) {
            echo "Please Enter a Part Number";
        } else {
            if(empty($boxQty)) {
                echo "Please Enter a Box Qty";
            } else {
                $result = $stock->update($partNumber, $boxQty,  $rackNumber, $dateRec, $boxID, $user);
                if($result == true) {
                    header("Location: " . BASE_URI) . "stores/stock/book-in";
                }
            }
        }
    }
