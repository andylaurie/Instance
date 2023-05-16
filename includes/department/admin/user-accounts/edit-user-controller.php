<?php

    $account = new Account();

    if(isset($_POST['updateButton'])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $department = $_POST['department'];
        $access = $_POST['access'];
        $enabled = $_POST['enabled'];
        $password = $_POST['password'];


        if(empty($username)) {
            alert("Please Enter a Username");
        } elseif(empty($department)) {
            alert("Please Enter a Department");
        } elseif(is_null($_POST['access'])) {
            alert("Please Enter an Access Level");
        } elseif($currentUserAccess < 3) {
            alert("You do not have permission to set access level this high.");
        } else {
            $result = $account->update($id, $username, $department, $access, $enabled);
            if (!empty($password)) {
                $account->updatePassword($id, $password);
            }
            if($result == true) {
                header("Location: " . BASE_URI . "admin/user-accounts");
            }
        }
    }

    $id = $_GET['id'];
    $details = $account->getUserDetailsId($id);
    if(!empty($_GET['id'])) {
        foreach ($details as $row) {
            $username = $row['username'];
            $department = $row['department'];
            $access = $row['access'];
            $enabled = $row['enabled'];
        }
    }
