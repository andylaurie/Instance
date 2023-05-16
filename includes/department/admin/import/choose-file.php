<div class="flexRow">
    <form action="" class="import" method="post" enctype="multipart/form-data">
        <div class="oso">
            <input type="file" id="import" name="csvFile" accept=".csv" />
            <div></div>
            <button type="submit">Upload</button>
            <div></div>
            <button type="reset">Cancel</button>
            <div></div>
        </div>
    </form>
    <div class="oso">
        <button onclick="infoButton()">Help</button>
    </div>
</div>

<script>
function infoButton() {
    window.alert("WARNING: Import (Replace) will replace all data.\n\n".concat(
    "Note: Import (Add) will add to existing data.\n",
    "Files must be in .csv format to be uploaded and imported.\n",
    "The first row contains column names,\n",
    "Columns must be in the following order,\n",
    "Model Number\n",
    "Product Code\n",
    "Description Top\n",
    "Description Bottom\n",
    "Supply Voltage\n",
    "Rated Input\n",
    "Serial Designation\n",
    "Serial Width\n",
    "Packed Weight\n",
    "Active\n",
    "Packed Dimensions"));
}
</script>
