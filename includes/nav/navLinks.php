<?php

// GENERATE NAV BUTTON...
    function getNavLink($name, $dept, $select) {
        // GET GLOBALS...
        global $uriAll;
        global $uriPath;
        global $uriQuery;

        // FORMAT FOR STYLESHEET CLASS...
        $base = strtok($name, '/');
        // FORMAT FOR LINK...
        $styleLink = BASE_URI.$dept.'/'.$name;
        // FORMAT FOR STLYSHEET ID...
        $styleId = str_replace('-', '', str_replace('/', '', $name));

        // IF SUB LINK...
        if ($select == 'sub') {
            // FORMAT NAME...
            $styleName = ucwords(str_replace('-', ' ', substr($name, strpos($name, "/") + 1)));
            // MAKE SUB LINK...
            $str = "<div class='navSubLink' id='link".$styleId."'>
                <a href='".$styleLink."'>".$styleName."</a></div>";
            // STYLE SUB LINK IF SELECTED...
            //if ($uriPath === BASE_URI.$dept.'/'.$name) {
            if (strpos($uriPath, $name) !== false) {
                $str = $str.getNavStyle($styleId, $select);
                // STYLE MENU ITEM IF SUB SELECTED...
                $str = $str.getNavStyle($base, 'menu');
            }
        }

        // IF MENU LINK...
        if ($select == 'menu') {
            // FORMAT NAME...
            $styleName = ucwords(str_replace('-', ' ', $name));
            // DECIDE WETHER TO USE ? OR &...
            if ($uriQuery != '') {
                $navGet = '&navLink=';
            } else {
                $navGet = '?navLink=';
            }
            // IF NAVLINK HAS BEEN SET, REMOVE IT FROM URI, ADD NEW LINK...
            if (isset($_GET['navLink'])) {
                $styleLink = substr(substr($uriAll, 0, strpos($uriAll, 'navLink')), 0, -1);
                $styleLink = $styleLink.$navGet.$name;
            } else {
                $styleLink = $uriAll.$navGet.$name;
            }
            // MAKE MENU LINK...
            $str = "<div class='navTopLink' id='link".$styleId."'>
                <a href='".$styleLink."'>".$styleName."</a></div>";
            // STYLE LINK...
            if (strpos($uriPath, $name) !== false) {
                $str = $str.getNavStyle($styleId, $select);
            }
        }

        // IF MAIN LINK...
        if ($select == 'main') {
            // FORMAT NAME...
            $styleName = ucwords(str_replace('-', ' ', $name));
            // MAKE MAIN LINK...
            $str = "<div class='navTopLink' id='link".$styleId."'>
                <a href='".$styleLink."'>".$styleName."</a></div>";
            // IF SELECTED STYLE LINK...
            if (strpos($uriPath, $name) !== false) {
                $str = $str.getNavStyle($styleId, $select);
            }
        }
        // RETURN LINK...
        return $str;
    }

// STYLE NAV BUTTON...
    function getNavStyle($name, $select) {
        // IF MAIN LINK...
        if ($select == 'main') {
            // SHADE BG...
            return "<style type='text/css'>#link".$name." a {
                color: #3d84d1;
            }</style>";
        }
// background: linear-gradient(90deg, #454545, #656565);
        // IF SUB LINK...
        if ($select == 'sub') {
            // SHADE BG...
            return "<style type='text/css'>#link".$name." a {
                color: #3d84d1;
            }</style>";
        }
    }

// background: linear-gradient(90deg, #505050, #707070);

// IF NAV LINK PRESSED...
    if (isset($_GET['navLink'])) {
        $navLink = $_GET['navLink'];
        // STYLE NAV LINK...
        echo "<style type='text/css'> #link".$navLink." a {color: #888;} </style>";
    } else {
        $navLink = '';
    }

// MENU URLS...
    $modifyUrl = BASE_URI .'admin/modify';
    $importUrl = BASE_URI .'admin/import';
    $exportUrl = BASE_URI .'admin/export';
    $stockUrl = BASE_URI .'stores/stock';
    $printUrl = BASE_URI .'stores/print';
    $locUrl = BASE_URI .'stores/locations';

// SET VARIABLE IF IS MENU URL...
    if (substr($uriPath, 0, strlen($modifyUrl)) === $modifyUrl) {
        $subMenu = 'modify';
    } elseif (substr($uriPath, 0, strlen($importUrl)) === $importUrl) {
        $subMenu = 'import';
    } elseif (substr($uriPath, 0, strlen($exportUrl)) === $exportUrl) {
        $subMenu = 'export';
    } elseif (substr($uriPath, 0, strlen($stockUrl)) === $stockUrl) {
        $subMenu = 'stock';
    } elseif (substr($uriPath, 0, strlen($printUrl)) === $printUrl) {
        $subMenu = 'print';
    } elseif (substr($uriPath, 0, strlen($locUrl)) === $locUrl) {
        $subMenu = 'locations';
    } else {
        $subMenu = '';
    }

// SHADE OPEN MENU NAME...
    if ($subMenu != '') {
        echo "<style type='text/css'> #link".$subMenu." a {color: #3d84d1;} </style>";
    }

// ADMIN LINKS...
    if($currentDepartment == "admin") {
        // MODIFY...
        echo(getNavLink('modify', 'admin', 'menu'));
        if ($subMenu == 'modify' or $navLink == 'modify') {
            echo(getNavLink('modify/locations', 'admin', 'sub'));
            echo(getNavLink('modify/custom-descriptions', 'admin', 'sub'));
            echo(getNavLink('modify/pick-sheets', 'admin', 'sub'));
            echo(getNavLink('modify/machine-details', 'admin', 'sub'));
        }
        // SETTINGS...
        echo(getNavLink('settings', 'admin', 'main'));
        if($currentUserAccess >= 3) {
            echo(getNavLink('user-accounts', 'admin', 'main'));
        }
        // IMPORT...
        echo(getNavLink('import', 'admin', 'menu'));
        if($subMenu == 'import' or $navLink == 'import') {
            echo(getNavLink('import/stock', 'admin', 'sub'));
            echo(getNavLink('import/main-locations', 'admin', 'sub'));
            echo(getNavLink('import/desp-locations', 'admin', 'sub'));
            echo(getNavLink('import/fact-locations', 'admin', 'sub'));
            echo(getNavLink('import/weld-locations', 'admin', 'sub'));
            echo(getNavLink('import/mach-locations', 'admin', 'sub'));
            echo(getNavLink('import/pronto-descriptions', 'admin', 'sub'));
            echo(getNavLink('import/custom-descriptions', 'admin', 'sub'));
            echo(getNavLink('import/machine-details', 'admin', 'sub'));
            echo(getNavLink('import/pick-sheets', 'admin', 'sub'));
        }
        // EXPORT...
        echo(getNavLink('export', 'admin', 'menu'));
        if($subMenu == 'export' or $navLink == 'export') {
            echo(getNavLink('export/stock', 'admin', 'sub'));
            echo(getNavLink('export/all-locations', 'admin', 'sub'));
            echo(getNavLink('export/pronto-descriptions', 'admin', 'sub'));
            echo(getNavLink('export/custom-descriptions', 'admin', 'sub'));
            echo(getNavLink('export/machine-details', 'admin', 'sub'));
            echo(getNavLink('export/pick-sheets', 'admin', 'sub'));
        }
        // NAV LINK SPACE...
        echo "<div class='navLinkSpace'></div>";
    }

// STORES LINKS...
    if($currentDepartment == "stores" or $currentDepartment == 'admin') {
        // STOCK...
        echo(getNavLink('stock', 'stores', 'menu'));
        if($subMenu == 'stock' or $navLink == 'stock') {
            echo(getNavLink('stock/goods-in', 'stores', 'sub'));
            echo(getNavLink('stock/book-in', 'stores', 'sub'));
            echo(getNavLink('stock/search', 'stores', 'sub'));
        }
        // PRINT...
        echo(getNavLink('print', 'stores', 'menu'));
        if($subMenu == 'print' or $navLink == 'print') {
            echo(getNavLink('print/spares', 'stores', 'sub'));
            echo(getNavLink('print/machines', 'stores', 'sub'));
            echo(getNavLink('print/pick-sheets', 'stores', 'sub'));
        }
        // LOCATIONS...
        echo(getNavLink('locations', 'stores', 'menu'));
        if($subMenu == 'locations' or $navLink == 'locations') {
            echo(getNavLink('locations/search-by-part', 'stores', 'sub'));
            echo(getNavLink('locations/search-by-rack', 'stores', 'sub'));
        }
        // LOG...
        echo(getNavLink('log', 'stores', 'main'));
    }
