<?php include('book-out-controller.php'); ?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">

        <div class="osl">
            <h6>Are you sure you want to book out <?= $partNumber; ?>? (<?= $description; ?> BoxID: <?= $boxID; ?>)</h6>
        </div>
        <div class="osl">
            <form class="formBookOut" action="<?= BASE_URI; ?>stores/stock/book-out-complete" method="post">
                <input type="hidden" name="boxID" value="<?= $boxID; ?>">
                <button type="submit" name="button">Book Out</button>
            </form>
            <div></div>
            <a href="javascript:history.back(1)">Cancel</a>
        </div>
    </div>
</div>
