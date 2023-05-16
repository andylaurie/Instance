<?php

class Constants {

// LOGIN...
    const LOGIN_FAILED = "Your username or password was incorrect";

// STOCK...
    const PN_DONT_EXIST  = "This is not a valid Part Number, or it miss-typed";
    const QTY_TOO_LARGE = "The quantity of this box is too large (>100,000)";
    const TOO_MANY_BOXES = "Too many boxes, check you have entered in the correct fields";
    const DATE_IN_FUTURE = "The date you have entered is in the future";

// IMPORT...
    const IMPORT_DETAILS = array(
        'stock' => TMP_DIR.'import/stock',
        'main-locations' => TMP_DIR.'import/mainLoc',
        'desp-locations' => TMP_DIR.'import/despLoc',
        'fact-locations' => TMP_DIR.'import/factLoc',
        'weld-locations' => TMP_DIR.'import/weldLoc',
        'mach-locations' => TMP_DIR.'import/machLoc',
        'machine-details' => TMP_DIR.'import/machDetail',
        'pronto-descriptions' => TMP_DIR.'import/prontoDesc',
        'custom-descriptions' => TMP_DIR.'import/customDesc',
        'pick-sheets' => TMP_DIR.'import/pickSheets');

// EXPORT...
    const EXPORT_DETAILS = array(
        'stock' => array(
            'path' => TMP_DIR.'export/stock',
            'headers' => array(
                'Part Number',
                'Rack Number',
                'Box Qty',
                'Date Received',
                'Box ID')),
        'all-locations' => array(
            'path' => TMP_DIR.'export/allLoc',
            'headers' => array(
                'Part Number',
                'Rack Number',
                'Bin Number')),
        'machine-details' => array(
            'path' => TMP_DIR.'export/machDetail',
            'headers' => array(
                'Model Number',
                'Product Code',
                'Description Top',
                'Description Bottom',
                'Supply Voltage',
                'Rated Input',
                'Serial Designation',
                'Serial Width',
                'Packed Weight',
                'Active',
                'Packed Dimensions',
                'brand')),
        'pronto-descriptions' => array(
            'path' => TMP_DIR.'export/prontoDesc',
            'headers' => array(
                'Part Number',
                'Description')),
        'custom-descriptions' => array(
            'path' => TMP_DIR.'export/customDesc',
            'headers' => array(
                'Part Number',
                'Description')),
        'pick-sheets' => array(
            'path' => TMP_DIR.'export/pickSheets',
            'headers' => array(
                'Part Number',
                'Qty Per',
                'Model Number',
                'Give To',
                'Group To'))
    );

}
