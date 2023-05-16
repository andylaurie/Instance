<?php include('goods-in-controller.php'); ?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">
        <div class="contentContainer">

            <div class="och">
                <h5 class="partNumber">Part Number</h5>
                <h5 class="description">Description</h5>
                <h5 class="boxQty">Box Qty</h5>
                <h5 class="dateRec">Date Received</h5>
                <h5 class="boxID">Box ID</h5>
            </div>
            <?php
                echo("<div class='hPad'></div>");
                foreach($result as $row) {
                    echo "<div class='ocb'>
                        <a href='". BASE_URI ."stores/stock/item?boxID=". $row['boxID'] ."'>
                            <h6 class='partNumber'>" . $row['partNumber'] . "</h6>
                            <h6 class='description'>" . $row['description'] . "</h6>
                            <h6 class='boxQty'>" . $row['boxQty'] . "</h6>
                            <h6 class='dateRec'>" . date('d-m-Y',strtotime($row['dateRec'])) . "</h6>
                            <h6 class='boxID'>" . $row['boxID'] . "</h6>
                        </a>
                    </div>";
                }
            ?>
        </div>
        <div class="osl">
            <?php
                if($rowQty > 45) {
                    include('includes/handlers/paginate-link-handler.php');
                }
            ?>
        </div>
    </div>
</div>
