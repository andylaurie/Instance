<?php

    $account = new Account();

    $id = $_GET['id'];

    if(isset($_POST['updatePassword'])) {
        $password = $_POST['password'];

        $detail = $account->getUserDetails($currentUser);
        $cid = $detail['id'];
        if ($cid != $id) {
            alert("You cannot change the password for someone else.");
        } elseif(!empty($password)) {
            $account->updatePassword($id, $password);
        }
    }
