<?php include('pick-selected-controller.php'); ?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">

        <div class="contentContainer">

            <div class="och">
                <h5 class="partNumber">Model Number</h5>
                <h5 class="descriptionShort">Description</h5>
                <h5 class="qtyPer">Quantity</h5>
                <h5 class="giveTo">Give To</h5>
                <h5 class="groupTo">Group</h5>
                <h5 class="rackNumber">Rack</h5>
                <h5 class="binNumber">Bin</h5>
            </div>
            <?php
                if(isset($_GET['modelNumber'])) {
                    echo("<div class='hPad'></div>");
                    foreach($result as $row) {
                        echo "<div class='ocb'>
                            <a href='#' class='noPoint'>
                                <h6 id='partNumber'>" . $row['partNumber'] . "</h6>
                                <h6 id='descriptionShort'>" . $row['description'] . "</h6>
                                <h6 id='qtyPer'>" . $row['qtyPer'] . "</h6>
                                <h6 id='giveTo'>" . $row['giveTo'] . "</h6>
                                <h6 id='groupTo'>" . $row['groupTo'] . "</h6>
                                <h6 id='rackNumber'>" . $row['rackNumber'] . "</h6>
                                <h6 id='binNumber'>" . $row['binNumber'] . "</h6>
                            </a>
                        </div>";
                    }
                }
            ?>
        </div>
        <div class="osl">
            <form target="_blank" action="" method="post">
                <input type="text" name="batchQty" placeholder="e.g. 10"></input>
                <div></div>
                <button type="submit" name="printButton">Print</button>
                <div></div>
                <a href="<?=BASE_URI.'stores/print/pick-sheets'?>">Cancel</a>
            </form>
        </div>
    </div>
</div>
