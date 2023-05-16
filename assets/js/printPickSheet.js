// INPUT PARAMETERS...
var batchQty = document.getElementById('batchQty');

// PRINT FUNCTION...
function printPickSheet() {
    if (document.getElementById('batchQty').value == 0) {
        alert("Please enter a quantity.");
        return;
    }
    try {
        // GET BATCH...
        batchQty = batchQty.value;
        // WRITE BATCH TO PAGE...
        document.getElementById("batch").innerHTML = batchQty;

        // LOAD PRINT...
        var pickSheet = document.getElementById('pickSheet');
        var popupWin = window.open('', '_blank', 'width=300,height=300');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + pickSheet.innerHTML + '</html>');
        popupWin.document.close();
    } catch(e) {
        alert(e.message || e);
    }
}
