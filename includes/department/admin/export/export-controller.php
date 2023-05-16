<?php

    $export = new Export($uriPath);

    $path = $export->getPath();
    $exportedFile = $export->getExported();

// EXPORT FILE...
    if (isset($_POST['exportFile'])) {
        $export->buttonExport();
    }

// DOWNLOAD FILE...
    if (isset($_POST['downloadFile'])) {
        header('location: '.BASE_URI.'assets/downloads/download.php');
    }

// DELETE FILE...
    if (isset($_POST['deleteFile'])) {
        $export->buttonDelete();
    }
