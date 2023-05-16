(function()
{
    // called when the document completly loaded
    function onload()
    {
        var partNumberText = document.getElementById('partNumber');
        var descriptionText = document.getElementById('description');
        var boxQtyText = document.getElementById('boxQty');
        var dateRecText = document.getElementById('dateRec');
        var boxIDText = document.getElementById('boxID');
        var printButton = document.getElementById('print');

        // FILE LOCATIONS...
        var labelFile = svrAdd + "Instance/assets/labels/stock.xml";

        // PRINT OPTIONS...
        var printParams = {};
        printParams.printQuality = 'Text';
        printParams.copies = 1;

        // ON PRINT BUTTON PRESS...
        printButton.onclick = function() {
            try {
                // OPEN LABEL TEMPLATE...
                var labelXML = dymo.label.framework.openLabelFile(labelFile);
                var label = dymo.label.framework.openLabelXml(labelXML);

                // CREATE LABEL SET...
                var labelSet = new dymo.label.framework.LabelSetBuilder();

                // ADD DATA...
                var record = labelSet.addRecord();
                    record.setText('partNumber', partNumberText.innerHTML);
                    record.setText('description', descriptionText.innerHTML);
                    record.setText('boxQty', boxQtyText.innerHTML);
                    record.setText('dateRec', dateRecText.innerHTML);
                    record.setText('boxID', boxIDText.innerHTML);

                // ADD PARAMETERS...
                var params = dymo.label.framework.createLabelWriterPrintParamsXml(printParams);

                // PRINT LABEL - PRINTER, PARAMS, LABEL...
                label.print('DYMO LabelWriter 4XL', params, labelSet);
            }
            catch(e) {
                alert(e.message || e);
            }
        }
    };

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

} ());
