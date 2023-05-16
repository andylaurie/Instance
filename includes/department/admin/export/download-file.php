<?php
    $_SESSION['downloadPath'] = $export->getPath().$export->getFile();
?>
<form action="" class="export" method="post">
    <div class="oso">
        <h5><?= $export->getExported(); ?></h5>
        <div></div>
        <button type="submit" name="downloadFile">Download</button>
        <div></div>
        <button type="submit" name="deleteFile">Delete</button>
    </div>
</form>
