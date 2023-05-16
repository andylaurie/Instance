<?php

    echo("<script src='".SVR_ADD."Instance/assets/js/Dymo.Label.Framework.3.0.js'
            type='text/javascript' charset='UTF-8'></script>");
    echo("<script src='".SVR_ADD."Instance/assets/js/printLocation.js'
            type='text/javascript' charset='UTF-8'></script>");
    include('selected-location-controller.php');

?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">

        <div class="contentContainer">

            <div class="och">
                <h5 class="partNumber">Part Number</h5>
                <h5 class="description">Description</h5>
                <h5 class="rackNumber">Rack Number</h5>
                <h5 class="rackNumber">Bin Number</h5>
            </div>
            <?php
                if(isset($_GET['sP'])) {
                    foreach($result as $row) {
                        echo "<div class='ocb'>
                            <h6 id='partNumber'>" . $row['partNumber'] . "</h6>
                            <h6 id='description'>" . $row['description'] . "</h6>
                            <h6 id='rackNumber'>" . $row['rackNumber'] . "</h6>
                            <h6 id='binNumber'>" . $row['binNumber'] . "</h6>
                        </div>";
                    }
                }
            ?>
        </div>
        <div class="osl">
            <button type="button" id="print">Print Label</button>
            <div></div>
            <a href="javascript:history.back(1)">Cancel</a>
        </div>
    </div>
</div>
