<?php include('book-in-controller.php'); ?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">
        <form id="formBookIn" method="post">
            <div class="osl">
                <h5 class="partNumber">Part Number</h5>
                <div></div>
                <h5 class="boxQty">Box Qty</h5>
                <div></div>
                <h5 class="qty">Boxes</h5>
                <div></div>
                <h5 class="dateRec">Date Received</h5>
            </div>
            <div class="osl">
                <input id="partNumber" type="text" name="partNumber" placeholder="e.g. AQ35">
                <div></div>
                <input id="boxQty" type="text" name="boxQty" placeholder="e.g. 1000">
                <div></div>
                <input id="qty" type="text" name="qty" placeholder="e.g. 5">
                <div></div>
                <input id="dateRec" type="date" name="dateRec" placeholder="Optional">
                <div></div>
                <button type="submit" name="bookInButton">Book In</button>
                <div></div>
                <a href="javascript:history.back(1)">Cancel</a>
            </div>
        </form>
    </div>
</div>
