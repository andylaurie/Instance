<?php include('search-rack-controller.php'); ?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">

        <form class='formSearch' id='formSearch' method='GET'>
            <div class='osu'>
                <input type='text' name='search' placeholder='e.g. F24'
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
                <h5 class="boxQty">Bin Number</h5>
            </div>
            <?php
                if(!empty($_GET['search'])) {
                    echo("<div class='hPad'></div>");
                    foreach($result as $row) {
                        echo "<div class='ocb'>
                            <a href='". BASE_URI ."stores/locations/item?sP=" . $row['partNumber'] . "&sR=" . $row['rackNumber'] . "'>
                                <h6 class='partNumber'>" . $row['partNumber'] . "</h6>
                                <h6 class='description'>" . $row['description'] . "</h6>
                                <h6 class='rackSelect'>" . $row['rackNumber'] . "</h6>
                                <h6 class='binNumber'>" . $row['binNumber'] . "</h6>
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
