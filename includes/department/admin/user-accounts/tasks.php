<?php

    $users = new Users($con);

// USER ACCOUNT LIST
    $userList = $users->getUserList();

// ENABLE / DISABLE USER ACCOUNTS
    if(isset($_GET['disableUserId'])) {
        $userId = $_GET['disableUserId'];
        $users->disableUser($userId);
    }
    if(isset($_GET['enableUserId'])) {
        $userId = $_GET['enableUserId'];
        $users->enableUser($userId);
    }
// RESET USER PASSWORD
        if(isset($_GET['resetUserId'])) {
            $userId = $_GET['resetUserId'];
            $users->resetUserPassword($userId);
        }


?>
<div class="overviewContainer">
    <?php getPageTitle(); ?>
    <div class="overviewSectionContainer">
        <div class="productionPlanContainer">

            <div class="headUsername">Username</div>
            <div class="headStatus">Status</div>
            <div class="headReset">Reset Password</div>

            <div class="detailsSection">
                <div class="detailContent">
                    <?php
                        while($row = mysqli_fetch_array($userList)) {
                            $row_status = $row['enabled'];
                            echo "<div class='detailRow'>
                                <div class='detailUsername'><a href='?editUserId=" . $row['id'] . "'>" . $row['username'] . "</a></div>";
                            if($row['username'] == 'Admin') {
                                echo "<div class='detailStatus'>Enabled</div>";
                            } elseif($row_status == '1') {
                                echo "<div class='detailStatus'><a href='?disableUserId=" . $row['id'] . "'>Enabled</a></div>";
                            } else {
                                echo "<div class='detailStatus'><a href='?enableUserId=" . $row['id'] . "'>Disabled</a></div>";
                            }
                            echo "<div class='detail'><a href='?resetUserId=" . $row['id'] . "'>Reset</a></div></div>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
            if(isset($_GET['editUserId'])) {
                $id=$_GET['editUserId'];
                $users->userEdit($id);
                include("includes/users/admin/forms/editUserAccount.php");
            }
        ?>
    </div>
</div>
