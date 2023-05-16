// ON PRINT BUTTON PRESS...
function printLabels() {
    var partNumberText = document.getElementById('hidden_partNumber');
    var descriptionText = document.getElementById('hidden_description');
    var qtyNum = document.getElementById('hidden_qty');
    var boxqtyNum = document.getElementById('hidden_boxQty');
    var dateRecText = document.getElementById('hidden_dateRec');
    var maxBoxID = document.getElementById('hidden_boxID');

    // FILE LOCATIONS...
    var labelFile = svrAdd + "Instance/assets/labels/stock.xml";

    // PRINT OPTIONS...
    var printParams = {};
    printParams.printQuality = 'Text';
    printParams.copies = 1;

    try {
        // OPEN LABEL TEMPLATE...
        var labelXML = dymo.label.framework.openLabelFile(labelFile);
        var label = dymo.label.framework.openLabelXml(labelXML);

        // CREATE LABEL SET...
        var labelSet = new dymo.label.framework.LabelSetBuilder();

        var i = 0;
        qtyNum = qtyNum.value;
        var id = maxBoxID.value - (qtyNum - 1);

        // ADD DATA...
        do {
            var record = labelSet.addRecord();
                record.setText('partNumber', partNumberText.value);
                record.setText('description', descriptionText.value);
                record.setText('boxQty', boxqtyNum.value);
                record.setText('dateRec', dateRecText.value);
                record.setText('boxID', id);
                i++;
                id++;
        }
        while (i < qtyNum);

        // ADD PARAMETERS...
        var params = dymo.label.framework.createLabelWriterPrintParamsXml(printParams);

        // PRINT LABEL - PRINTER, PARAMS, LABEL...
        label.print('DYMO LabelWriter 4XL', params, labelSet);
    }
    catch(e) {
        alert(e.message || e);
    }
    alert('Stock Booked In, Labels should be printing.' );
    window.location = '/Instance/stores/stock/book-in';
}


function initTests() {
	if(dymo.label.framework.init) {
		//dymo.label.framework.trace = true;
		dymo.label.framework.init(onload);
	} else {
		onload();
	}
}

// register onload event
if (window.addEventListener)
	window.addEventListener("load", initTests, false);
else if (window.attachEvent)
	window.attachEvent("onload", initTests);
else
	window.onload = initTests;
