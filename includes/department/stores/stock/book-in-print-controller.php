<script src="http://server.ac-home.net:2247/Instance/assets/js/Dymo.Label.Framework.3.0.js" type="text/javascript" charset="UTF-8"></script>
<script src="http://server.ac-home.net:2247/Instance/assets/js/printStockIn.js" type="text/javascript" charset="UTF-8"></script>

<input id="hidden_partNumber" type="hidden" value="<?= $partNumber ?>">
<input id="hidden_description" type="hidden" value="<?= $description ?>">
<input id="hidden_boxQty" type="hidden" value="<?= $boxQty ?>">
<input id="hidden_qty" type="hidden" value="<?= $qty ?>">
<input id="hidden_dateRec" type="hidden" value="<?= $dateRec ?>">
<input id="hidden_boxID" type="hidden" value="<?= $maxBoxID ?>">

<script type="text/javascript" charset="UTF-8">
    printLabels();
</script>
<?php // header("Location: " . BASE_URI . "stores/stock/book-in"); ?>
