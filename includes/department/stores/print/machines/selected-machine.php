<?php

echo("<script src='".SVR_ADD."Instance/assets/js/Dymo.Label.Framework.3.0.js'
        type='text/javascript' charset='UTF-8'></script>");
echo("<script src='".SVR_ADD."Instance/assets/js/printMachines.js'
        type='text/javascript' charset='UTF-8'></script>");

include('machine-selected-controller.php');

?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">

        <div class="contentContainer">

            <div class="och">
                <h5 class="partNumber">Part Number</h5>
                <h5 class="description">Description</h5>
            </div>
            <?php
                if(isset($_GET['modelNumber'])) {
                    foreach($result as $row) {
                        echo "<div class='ocb'>
                            <h6 id='modelNumber'>" . $row['modelNumber'] . "</h6>
                            <h6 id='descriptionTop'>" . $row['descriptionTop'] . "</h6>
                            <div></div>
                            <h6 id='descriptionBottom'>" . $row['descriptionBottom'] . "</h6>
                            <input id='serialDesignation' type='hidden' value='" . $row['serialDesignation'] . "'></input>
                            <input id='supplyVoltage' type='hidden' value='" . $row['supplyVoltage'] . "'></input>
                            <input id='ratedInput' type='hidden' value='" . $row['ratedInput'] . "'></input>
                            <input id='serialWidth' type='hidden' value='" . $row['serialWidth'] . "'></input>
                            <input id='packedWeight' type='hidden' value='" . $row['packedWeight'] . "'></input>
                            <input id='brand' type='hidden' value='" . $row['brand'] . "'></input>
                        </div>";
                    }
                }
            ?>
        </div>
        <div class="osl">
            <input type="text" id="qty" placeholder="e.g. 20"></input>
            <div></div>
            <input type="text" id="serialNumber" placeholder="e.g. 123"></input>
            <div></div>
            <button type="button" id="print">Print Label</button>
            <div></div>
            <a href="javascript:history.back(1)">Cancel</a>
        </div>
    </div>
</div>
