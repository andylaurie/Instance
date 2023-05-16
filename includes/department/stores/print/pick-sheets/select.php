<?php include('pick-select-controller.php'); ?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">

        <div class="contentContainer">
            <div class="och">
                <h5 class="partNumber">Model Number</h5>
                <h5 class="description">Description</h5>
            </div>
            <?php
                echo("<div class='hPad'></div>");
                foreach($result as $row) {
                    echo "<div class='ocb'>
                        <a href='". BASE_URI ."stores/print/pick-sheets/item?modelNumber=". $row['modelNumber'] ."'>
                            <h6 class='modelNumber'>" . $row['modelNumber'] . "</h6>
                            <h6 class='description'>" . $row['description'] . "</h6>
                        </a>
                    </div>";
                }
            ?>
        </div>
        <div class="osl">
            <?php include('includes/handlers/paginate-link-handler.php'); ?>
        </div>
    </div>
</div>
