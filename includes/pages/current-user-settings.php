<?php include('current-user-settings-controller.php'); ?>
<div class="objectContainer">
    <?php include('includes/handlers/page-title-handler.php'); ?>
    <div class="sectionContainer">

        <form id="formUpdatePassword" method="post">
            <div class="osl">
                <div></div>
                <h5 class="Password">Change Password</h5>
            </div>
            <div class="osl">
                <input id="password" type="password" name="password">
                <div></div>
                <button type="submit" name="updatePassword">Update</button>
                <div></div>
                <a href="javascript:history.back(1)">Cancel</a>
            </div>
        </form>

    </div>
</div>
