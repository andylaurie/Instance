<?php

    $user = $_SESSION['userLoggedIn'];

    $account = new Account();
    $result = $account->getSetting($user);

    include("includes/handlers/settings-handler.php");

?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">
        <div class="contentContainer">
            <div class="detailHead">
                <div class="headSetting">Setting</div>
                <div class="headOption">Option</div>
            </div>
            <div class="detailRow">
                <div class="detailSetting">Auto print label after Book In</div>
                <input type="text" name="auto-print-label-after-book-in" value="">
            </div>
            <div class="detailRow">
                <div class="detailSetting">Auto print label after Update</div>
                <input type="text" name="auto-print-label-after-update" value="">
            </div>
            <div class="detailRow">
                <div class="detailSetting">Default home page</div>
                <input type="text" name="default-home-page" value="">
            </div>
            <div class="detailRow">
                <div class="detailSetting">Print 2 box labels</div>
                <input type="text" name="print-2-box-labels" value="">
            </div>
        </div>
    </div>
</div>
