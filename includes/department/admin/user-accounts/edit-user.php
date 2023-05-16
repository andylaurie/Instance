<?php include('edit-user-controller.php'); ?>
<div class="objectContainer">
    <?php getPageTitle(); ?>
    <div class="sectionContainer">
        <form id="formUserUpdate" method="post">
            <div class="osl">
                <h5 class="username">Username</h5>
                <h5 class="department">Department</h5>
                <h5 class="access">Access Level</h5>
                <h5 class="enabled">Enabled</h5>
                <h5 class="password">Password</h5>
            </div>
            <div class="osl">
                <input type="hidden" id="id" name="id" value="<?= $id; ?>">
                <input id="username" type="text" name="username" value="<?= $username; ?>">
                <div></div>
                <input id="department" type="text" name="department" value="<?= $department; ?>">
                <div></div>
                <input id="access" type="text" name="access" value="<?= $access; ?>">
                <div></div>
                <span class="checkspan">
                    <input id="enabled" type="checkbox" name="enabled" value="yes"
                    <?php if ($enabled == 'yes') echo "checked='checked'"; ?>>
                </span>
                <div></div>
                <input id="password" type="password" name="password" placeholder="Unchanged if Blank">
                <div></div>
                <button type="submit" name="updateButton">Update</button>
                <div></div>
                <a href="javascript:history.back(1)">Cancel</a>
            </div>
        </form>

    </div>
</div>

<div class="pageNote">
    Note:<br>
    Department - stores or admin<br>
    Access Level - (4, Sysadmin / 3, Admin / 2, Department Head / 1, Regular User)<br>
    Enabled - (Yes, User Active / No, User cant log-in)
</div>
