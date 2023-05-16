<?php include('search-controller.php'); ?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">

        <form class='formSearch' id='formSearch' method='GET'>
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
                <h5 class="rackSelect">Rack Number</h5>
                <h5 class="boxQty">Box Qty</h5>
                <h5 class="dateRec">Date Received</h5>
                <h5 class="boxID">Box ID</h5>
            </div>
            <?php
                if(!empty($_GET['search'])) {
                    echo("<div class='hPad'></div>");
                    foreach($result as $row) {
                        echo "<div class='ocb'>
                            <a href='". BASE_URI ."stores/stock/item?boxID=". $row['boxID'] ."'>
                                <h6 class='partNumber'>" . $row['partNumber'] . "</h6>
                                <h6 class='description'>" . $row['description'] . "</h6>
                                <h6 class='rackSelect'>" . $row['rackNumber'] . "</h6>
                                <h6 class='boxQty'>" . $row['boxQty'] . "</h6>
                                <h6 class='dateRec'>" . date('d-m-Y',strtotime($row['dateRec'])) . "</h6>
                                <h6 class='boxID'>" . $row['boxID'] . "</h6>
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
