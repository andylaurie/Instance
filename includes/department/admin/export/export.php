<?php include('includes/department/admin/export/export-controller.php'); ?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">
        <?php
            if ($export->noFile() == true) {
                include('includes/department/admin/export/export-file.php');
            } else {
                include('includes/department/admin/export/download-file.php');
            }
        ?>
    </div>
</div>
