<?php

    define('FPDF_FONTPATH','includes/classes/FPDF/font/');

    $pickData = new PickData();
    if(isset($_GET['modelNumber'])) {
        $modelNumber = $_GET['modelNumber'];
        $result = $pickData->getModelDetails($modelNumber);

        if(isset($_POST['printButton'])) {
            if (empty($batchQty = $_POST['batchQty'])) {
                alert('Enter a Qty.');
            } else {
                $batchQty = $_POST['batchQty'];
                $pickSheet = new PickSheet();
                ob_clean();
                $pickSheet->AliasNbPages();
                $pickSheet->AddPage('P','A4',0);
                $pickSheet->headerTable();
                $pickSheet->dataTable($result, $batchQty);
                $pickSheet->addLine();
                ob_start();
                $pickSheet->Output('PickSheet.pdf', 'I');
                ob_end_flush();
            }
        }
    }
