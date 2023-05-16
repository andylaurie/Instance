<?php include('includes/handlers/stock-update-handler.php'); ?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">

        <form id="formStockUpdate" method="post">
            <div class="osl">
                <h5 class="partNumber">Part Number</h5>
                <div></div>
                <h5 class="boxQty">Box Qty</h5>
                <div></div>
                <h5 class="rackNumber">Rack Number</h5>
                <div></div>
                <h5 class="dateRec">Date Received</h5>
                <div></div>
                <h5 class="boxID">BoxID</h5>
            </div>
            <div class="osl">
                <input id="partNumber" type="text" name="partNumber" placeholder="e.g. AQ35" value="<?= $partNumber; ?>">
                <input id="description" type="hidden" value="<?= $row['description']; ?>">
                <div></div>
                <input id="boxQty" type="text" name="boxQty" placeholder="e.g. 1000" value="<?= $boxQty; ?>">
                <div></div>
                <select id="rackNumber" name="rackNumber" placeholder="e.g. US10">
                    <?php
                        foreach ($options as $value => $text) {
                            if ($value == $rackNumber) {
                                echo "<option value='$value' selected='selected'>$text</option>";
                            } else {
                                echo "<option value='$value'>$text</option>";
                            }
                        }
                    ?>
                </select>
                <div></div>
                <input id="dateRec" type="date" name="dateRec" value="<?= $dateRec; ?>">
                <div></div>
                <input id="boxID" type="text" name="boxID" value="<?= $boxID; ?>" readonly="readonly">
                <div></div>
                <button type="submit" name="updateButton">Update</button>
                <div></div>
                <a href="javascript:history.back(1)">Cancel</a>
            </div>
        </form>

    </div>
</div>
