<?php

    if(isset($_POST['stockUpdateButton'])) {

        $partNumber = $_POST['partNumber'];
        $boxQty = $_POST['boxQty'];
        $rackNumber = $_POST['rackNumber'];
        $dateRec = $_POST['dateRec'];
        $boxID = $_POST['boxID'];
        $user = $_SESSION['userLoggedIn'];

        $exists = $stock->checkPartNumber($partNumber);

        function alert($msg) {
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }

        if(empty($rackNumber)) {
            $rackNumber = NULL;
        }

        if(empty($partNumber)) {
            alert("Please Enter a Part Number");
        } elseif($exists < 1) {
            alert("Part Number does not exist, please check your spelling");

        } elseif(empty($boxQty)) {
            alert("Please Enter a Box Qty");
        } else {
            $result = $stock->update($partNumber, $boxQty,  $rackNumber, $dateRec, $boxID, $user);
            if($result == true) {
                header("Location: " . BASE_URI) . "stores/stock/book-in";
            }
        }

    }

    function removeItem($id) {
        $result = $stock->bookOut($id);
        if($result == true) {
            header("Location: " . BASE_URI) . "stores/stock/book-in";
        }
    }
