<?php

// GET USER ID...
    $detail = $account->getUserDetails($currentUser);
    $id = $detail['id'];

?>
<!-- banner -->
<div class="titleBar">
    <div class="logoTitle">
        <img id="bannerLogo" src="<?= BASE_URI; ?>assets/images/logo/Instance-Logo-WHITE-png2.png">
    </div>
    <div class="pageTitle">
        <?= ucfirst($currentDepartment); ?>
    </div>
    <div class="userTitle">
        <?= ucfirst($currentUser); ?>
    </div>
    <a href="<?= BASE_URI . $currentDepartment; ?>/user-settings?id=<?= $id; ?>">
        <div class="userAccount">
            <img id="accountIcon" src="<?= BASE_URI; ?>assets/images/account-icon5.png">
        </div>
    </a>
</div>
