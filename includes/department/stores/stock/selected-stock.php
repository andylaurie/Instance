<?php

    echo("<script src='".SVR_ADD."Instance/assets/js/Dymo.Label.Framework.3.0.js'
            type='text/javascript' charset='UTF-8'></script>");
    echo("<script src='".SVR_ADD."Instance/assets/js/printStock.js'
            type='text/javascript' charset='UTF-8'></script>");

    include('selected-stock-controller.php');

?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">

        <div class="contentContainer">

            <div class="och">
                <h5 class="partNumber">Part Number</h5>
                <h5 class="description">Description</h5>
                <h5 class="rackSelect">Rack Number</h5>
                <h5 class="boxQty">Box Qty</h5>
                <h5 class="dateRec">Date Received</h5>
                <h5 class="boxID">Box ID</h5>
            </div>
            <?php
                if(isset($_GET['boxID'])) {
                    foreach($result as $row) {
                        echo "<div class='ocb'>
                            <h6 id='partNumber'>" . $row['partNumber'] . "</h6>
                            <h6 id='description'>" . $row['description'] . "</h6>
                            <h6 id='rackSelect'>" . $row['rackNumber'] . "</h6>
                            <h6 id='boxQty'>" . $row['boxQty'] . "</h6>
                            <h6 id='dateRec'>" . date('d-m-Y',strtotime($row['dateRec'])) . "</h6>
                            <h6 id='boxID'>" . $row['boxID'] . "</h6>
                        </div>";
                    }
                }
            ?>
        </div>
        <div class="osl">
            <a href="<?= BASE_URI; ?>stores/stock/update?boxID=<?= $row['boxID']; ?>">Update</a>
            <div></div>
            <a href="<?= BASE_URI; ?>stores/stock/book-out?boxID=<?= $row['boxID']; ?>">Book Out</a>
            <div></div>
            <button type="button" id="print">Print Label</button>
            <div></div>
            <a href="javascript:history.back(1)">Cancel</a>
        </div>
    </div>
</div>
