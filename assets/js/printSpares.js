(function() {
    // RUN WHEN DOCUMENT LOADED...
    function onload() {
        var partNumberText = document.getElementById('partNumber');
        var descriptionText = document.getElementById('description');
        var labelType = document.getElementById('type');
        var printButton = document.getElementById('print');

        // FILE LOCATIONS...
        var path = {};
        path["sparesSmall"] = svrAdd + "Instance/assets/labels/sparesSmall.xml";
        path["sparesLarge"] = svrAdd + "Instance/assets/labels/sparesLarge.xml";
        path["sparesSmallZip"] = svrAdd + "Instance/assets/labels/sparesSmallZip.xml";
        path["sparesLargeZip"] = svrAdd + "Instance/assets/labels/sparesLargeZip.xml";

        // PRINT OPTIONS...
        var printParams = {};
        printParams.printQuality = 'Text';

        // ON PRINT BUTTON PRESS...
        printButton.onclick = function() {
            try {
                printParams.copies = document.getElementById('copies').value;
                if(document.getElementById('copies').value == 0) {
                    alert('Please enter a number of copies');
                }

                // OPEN LABEL TEMPLATE...
                var labelXML = dymo.label.framework.openLabelFile(path[labelType.value]);
                var label = dymo.label.framework.openLabelXml(labelXML);

                // CREATE LABEL SET...
                var labelSet = new dymo.label.framework.LabelSetBuilder();

                // ADD DATA...
                var record = labelSet.addRecord();
                record.setText('partNumber', partNumberText.innerHTML);
                record.setText('description', "Description: ".concat(descriptionText.innerHTML));

                // ADD PARAMETERS...
                var params = dymo.label.framework.createLabelWriterPrintParamsXml(printParams);

                // PRINT LABEL - PRINTER, PARAMS, LABEL...
                if(labelType.value == "sparesSmall" || labelType.value == "sparesSmallZip") {
                    var printer = 'DYMO LabelWriter 450 Twin Turbo';
                    printParams.twinTurboRoll = 'Left';
                } else if(labelType.value == "sparesLarge" || labelType.value == "sparesLargeZip") {
                    var printer = 'DYMO LabelWriter 4XL';
                }
                label.print(printer, params, labelSet);
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
