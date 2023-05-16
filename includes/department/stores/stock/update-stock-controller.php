<?php

    $stock = new Stock();

    if(isset($_POST['updateButton'])) {

        $partNumber = $_POST['partNumber'];
        $boxQty = $_POST['boxQty'];
        $rackNumber = $_POST['rackNumber'];
        $dateRec = $_POST['dateRec'];
        $boxID = $_POST['boxID'];
        $user = $_SESSION['userLoggedIn'];

        $exists = $stock->checkExists($partNumber);

        if(empty($rackNumber)) {
            $rackNumber = NULL;
        }

        if(empty($partNumber)) {
            alert("Please Enter a Part Number");
        } elseif(empty($exists)) {
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

    $id = $_GET['boxID'];
    $details = $stock->getDetails($id);
    if(!empty($_GET['boxID'])) {
        foreach ($details as $row) {
            $partNumber = $row['partNumber'];
            $description = $row['description'];
            $boxQty = $row['boxQty'];
            $rackNumber = $row['rackNumber'];
            $dateRec = date('Y-m-d',strtotime($row['dateRec']));
            $boxID = $row['boxID'];
        }

    }

    $options = [
        '' => 'Goods In',
        'US1' => 'US1',
        'US2' => 'US2',
        'US3' => 'US3',
        'US4' => 'US4',
        'US5' => 'US5',
        'US6' => 'US6',
        'US7' => 'US7',
        'US8' => 'US8',
        'US9' => 'US9',
        'US10' => 'US10',
        'US11' => 'US11',
        'US12' => 'US12',
        'US13' => 'US13',
        'US14' => 'US14',
        'US15' => 'US15',
        'US16' => 'US16',
        'MSR' => 'MSR',
        'MSF' => 'MSF',
        'USQ' => 'USQ'
    ];
