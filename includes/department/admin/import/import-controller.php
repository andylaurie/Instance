<?php

    $import = new Import($uriPath);
    $path = $import->getPath();

// ON UPLOAD BUTTON PRESS...
    if (isset($_FILES['csvFile'])) {
        $import->uploadButton();
    }

// GET UPLOADED FILE NAME...
    if ($import->noFile() == false) {
        $storedFile = $import->getSavedFile();
    }

// DELETE UPLOADED FILE...
    if (isset($_POST['deleteFile'])) {
        $import->deleteButton();
    }

// IMPORT AND ADD DATA TO DATABASE...
    if (isset($_POST['importAddFile'])) {
        $import->addButton();
    }

// IMPORT AND REPLACE DATA TO DATABASE...
    if (isset($_POST['importRepFile'])) {
        $import->replaceButton();
    }
