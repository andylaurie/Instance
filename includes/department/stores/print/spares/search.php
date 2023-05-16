<?php include('search-controller.php'); ?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">

        <form class='formPrintSparesSearch' id='formSearchPartNumber' method='GET'>
            <div class='osu'>
                <input type='text' name='search' placeholder='e.g. AQ35-SP'
                value="<?php if(!empty($_GET['search'])) { echo $searchTerm; } ?>">
                <div></div>
                <button type='submit'>Search</button>
            </div>
        </form>

        <div class="contentContainer">
            <div class="och">
                <h5 class="partNumber">Part Number</h5>
                <h5 class="description">Description</h5>
            </div>
            <?php
                if(!empty($_GET['search'])) {
                    echo("<div class='hPad'></div>");
                    foreach($result as $row) {
                        echo "<div class='ocb'>
                            <a href='". BASE_URI ."stores/print/spares/item?partNumber=". $row['partNumber'] ."'>
                                <h6 class='partNumber'>" . $row['partNumber'] . "</h6>
                                <h6 class='description'>" . $row['description'] . "</h6>
                            </a>
                        </div>";
                    }
                }
            ?>
        </div>
        <?php
            if(isset($_GET['search']) AND $rowQty > 30) {
                include('includes/handlers/paginate-search-link-handler.php');
            }
        ?>
    </div>
</div>
