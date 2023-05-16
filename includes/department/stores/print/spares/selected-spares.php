<?php

    echo("<script src='".SVR_ADD."Instance/assets/js/Dymo.Label.Framework.3.0.js'
            type='text/javascript' charset='UTF-8'></script>");
    echo("<script src='".SVR_ADD."Instance/assets/js/printSpares.js'
            type='text/javascript' charset='UTF-8'></script>");

    include('selected-spares-controller.php');

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
                if(isset($_GET['partNumber'])) {
                    foreach($result as $row) {
                        echo "<div class='ocb'>
                            <h6 id='partNumber'>" . $row['partNumber'] . "</h6>
                            <h6 id='description'>" . $row['description'] . "</h6>
                        </div>";
                    }
                }
            ?>
        </div>
        <div class="osl">
            <input type="text" class="numberOfCopies" id="copies" value="1"></input>
            <div></div>
            <select class="labelType" id="type">
                <option value="sparesSmall" selected="selected">Small</option>
                <option value="sparesLarge">Large</option>
                <option value="sparesSmallZip">ZIP Small</option>
                <option value="sparesLargeZip">ZIP Large</option>
            </select>
            <div></div>
            <button type="button" id="print">Print Label</button>
            <div></div>
            <a href="javascript:history.back(1)">Cancel</a>
        </div>
    </div>
</div>
