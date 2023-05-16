<?php

    session_start();
    $download = $_SESSION['downloadPath'];

if (file_exists($download)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($download).'"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($download));
    ob_clean();
    flush();
    readfile($download);
    exit;
} else {
    echo('There was an error downloading the file!');
    echo($download);
}

?>
