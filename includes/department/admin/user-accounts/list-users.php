<?php include('list-users-controller.php'); ?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">
        <div class='osh'>
            <h4>Click on a user to edit details</h4>
            <div></div>
            <a href="<?= BASE_URI; ?>admin/user-accounts/add-user">+ Add User</a>
        </div>
        <div class="contentContainer">

            <div class="och">
                <h5 class="username">Username</h5>
                <h5 class="department">Department</h5>
                <h5 class="access">Access Level</h5>
                <h5 class="enabled">Enabled</h5>
            </div>
            <?php
                echo("<div class='hPad'></div>");
                foreach($result as $row) {
                    $userId = $row['id'];
                    $username = $row['username'];
                    $department = $row['department'];
                    $access = $row['access'];
                    $enabled = ucfirst($row['enabled']);
                    echo "<div class='ocb'>
                        <a href='". BASE_URI ."admin/user-accounts/edit-user?id=$userId'>
                            <h6 class='username'>$username</h6>
                            <h6 class='department'>$department</h6>
                            <h6 class='access'>$access</h6>
                            <h6 class='enabled'>$enabled</h6>
                        </a>
                    </div>";
                }
            ?>
        </div>
        <?php
            if($rowQty > 30) {
                include('includes/handlers/paginate-link-handler.php');
            }
        ?>
    </div>
</div>
