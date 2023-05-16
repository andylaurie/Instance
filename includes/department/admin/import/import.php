<?php include('includes/department/admin/import/import-controller.php'); ?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">
        <?php
            if ($import->noFile() == true) {
                include('includes/department/admin/import/choose-file.php');
            } else {
                include('includes/department/admin/import/import-file.php');
            }
        ?>
    </div>
</div>
