<?php

// LOGGED-IN CHECK...
    if ($uriPath == BASE_URI && isset($_SESSION['userLoggedIn'])) {
        if ($currentDepartment == 'stores') {
            header('Location: ' . BASE_URI . 'stores/stock/goods-in');
            exit;
        } elseif ($currentDepartment == 'admin') {
            header('Location: ' . BASE_URI . 'stores/stock/goods-in');
            exit;
        }
    }

// HOME PAGE SELECTION...
    elseif ($uriPath == BASE_URI .'stores'
        and $currentDepartment == 'stores') {
        header('Location: ' .BASE_URI. 'stores/stock/goods-in');
    }
    elseif ($uriPath == BASE_URI .'admin'
        and $currentDepartment == 'admin') {
        header('Location: ' .BASE_URI. 'stores/stock/goods-in');
    }

// STORES PAGES...
    elseif ($uriPath == BASE_URI . 'stores/stock/goods-in'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/stock/goods-in.php");
    }
    elseif ($uriPath == BASE_URI .'stores/stock/item'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/stock/selected-stock.php");
    }
    elseif ($uriPath == BASE_URI .'stores/stock/update'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/stock/update-stock.php");
    }
    elseif ($uriPath == BASE_URI .'stores/stock/book-in'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/stock/book-in.php");
    }
    elseif ($uriPath == BASE_URI .'stores/stock/book-out'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/stock/book-out.php");
    }
    elseif ($uriPath == BASE_URI .'stores/stock/book-out-complete'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/stock/book-out-complete-controller.php");
    }
    elseif ($uriPath == BASE_URI .'stores/stock/search'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/stock/search.php");
    }
    elseif ($uriPath == BASE_URI .'stores/print/spares'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/print/spares/search.php");
    }
    elseif ($uriPath == BASE_URI .'stores/print/spares/item'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/print/spares/selected-spares.php");
    }
    elseif ($uriPath == BASE_URI .'stores/print/machines'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/print/machines/select.php");
    }
    elseif ($uriPath == BASE_URI .'stores/print/machines/item'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/print/machines/selected-machine.php");
    }
    elseif ($uriPath == BASE_URI .'stores/print/spares-labels/options'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/print/spares-labels/print-selected.php");
    }
    elseif ($uriPath == BASE_URI .'stores/print/pick-sheets'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/print/pick-sheets/select.php");
    }
    elseif ($uriPath == BASE_URI .'stores/print/pick-sheets/item'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/print/pick-sheets/selected-pick.php");
    }
    elseif ($uriPath == BASE_URI .'stores/locations/search-by-part'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/locations/search-part.php");
    }
    elseif ($uriPath == BASE_URI .'stores/locations/search-by-rack'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/locations/search-rack.php");
    }
    elseif ($uriPath == BASE_URI .'stores/locations/item'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/locations/selected-location.php");
    }
    elseif ($uriPath == BASE_URI .'stores/account-settings'
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/department/stores/account-settings.php");
    }
    elseif (($uriPath == BASE_URI .'stores/log' || $uriPath == BASE_URI . 'admin/log')
        and $currentUserAccess >= 1
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/pages/log.php");
    }

// ADMIN ONLY PAGES...
    elseif ($uriPath == BASE_URI .'admin/modify/custom-descriptions'
        and $currentDepartment == 'admin'
        and $currentUserAccess >= 2) {
        include("includes/department/admin/modify/edit-descriptions.php");
    }
    elseif ($uriPath == BASE_URI .'admin/modify/locations'
        and $currentDepartment == 'admin'
        and $currentUserAccess >= 2) {
        include("includes/department/admin/modify/locations/search.php");
    }
    elseif ($uriPath == BASE_URI . 'admin/user-accounts'
        and $currentDepartment == 'admin'
        and $currentUserAccess >= 3) {
        include("includes/department/admin/user-accounts/list-users.php");
    }
    elseif ($uriPath == BASE_URI .'admin/user-accounts/edit-user'
        and $currentDepartment == 'admin'
        and $currentUserAccess >= 2) {
        include("includes/department/admin/user-accounts/edit-user.php");
    }
    elseif (($uriPath == BASE_URI .'admin/import/stock')
        || ($uriPath == BASE_URI .'admin/import/main-locations')
        || ($uriPath == BASE_URI .'admin/import/desp-locations')
        || ($uriPath == BASE_URI .'admin/import/fact-locations')
        || ($uriPath == BASE_URI .'admin/import/weld-locations')
        || ($uriPath == BASE_URI .'admin/import/mach-locations')
        || ($uriPath == BASE_URI .'admin/import/machine-details')
        || ($uriPath == BASE_URI .'admin/import/pronto-descriptions')
        || ($uriPath == BASE_URI .'admin/import/custom-descriptions')
        || ($uriPath == BASE_URI .'admin/import/pick-sheets')
        && ($currentDepartment == 'admin')
        && ($currentUserAccess >= 2)) {
        include("includes/department/admin/import/import.php");
    }
    elseif (($uriPath == BASE_URI .'admin/export/stock')
        || ($uriPath == BASE_URI .'admin/export/all-locations')
        || ($uriPath == BASE_URI .'admin/export/pronto-descriptions')
        || ($uriPath == BASE_URI .'admin/export/custom-descriptions')
        || ($uriPath == BASE_URI .'admin/export/machine-details')
        || ($uriPath == BASE_URI .'admin/export/pick-sheets')
        && ($currentDepartment == 'admin')
        && ($currentUserAccess >= 2)) {
        include("includes/department/admin/export/export.php");
    }

// USER SETTINGS PAGE...
    elseif (strpos($uriPath, BASE_URI . $currentDepartment . '/user-settings') === 0) {
        include("includes/pages/current-user-settings.php");
    }

// IF NOT LOGGED IN...
    elseif(!isset($_SESSION['userLoggedIn'])){
        header('Location: ' . BASE_URI . 'login.php');
    }

// COMMENT OUT BELOW FOR TESTING - - - - - - - - - - - - - - - - - - - - - - - -
// OOPS ERROR PAGE...
    elseif ($uriPath == (BASE_URI.$currentDepartment. '/oops')
        and $currentUserAccess >= 0
        and ($currentDepartment == 'stores') || ($currentDepartment == 'admin')) {
        include("includes/pages/not-found.php");
    }
// IF PAGE NOT FOUND...
//    else {
//        header('Location: ' .BASE_URI.$currentDepartment. '/oops');
//    }
