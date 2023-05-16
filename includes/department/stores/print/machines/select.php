<?php include('machine-select-controller.php'); ?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">
        <div class="contentContainer">
            <div class="och">
                <h5 class="modelNumber">Machine</h5>
                <h5 class="descriptionTop">Description</h5>
                <h5 class="descriptionBottom"></h5>
            </div>
            <?php
                echo("<div class='hPad'></div>");
                foreach($result as $row) {
                    echo "<div class='ocb'>
                        <a href='". BASE_URI ."stores/print/machines/item?modelNumber=". $row['modelNumber'] ."'>
                            <h6 class='modelNumber'>" . $row['modelNumber'] . "</h6>
                            <h6 class='descriptionTop'>" . $row['descriptionTop'] . "</h6>
                            <div></div>
                            <h6 class='descriptionBottom'>" . $row['descriptionBottom'] . "</h6>
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
