(function() {
    // ON PAGE LOAD...
    function onload() {
        // GET ARRAY FROM PHP...
        var printArray = JSON.parse(<?php echo json_encode($printArray); ?>);
        // GET PRINT PARAMETERS FROM ARRAY...
        var printParams = {};
        printParams.printQuality = printArray.settings.quality.value;
        printParams.copies = printArray.copies.value;
        // GET PRINTER FROM ARRAY...
        var dymoPrinter = printArray.settings.settings.printer.value;

        // ON PRINT BUTTON PRESS...
        printButton.onclick = function()
        {
            try
            {
                var labelXML = labelUpper + labelLogo + labelLower;
                var label = dymo.label.framework.openLabelXml(labelXML);
                // CREATE LABEL SET...
                var labelSet = new dymo.label.framework.LabelSetBuilder();
                // ADD DATA...
                printArray.settings.set.forEach((set) => {
                    var record = labelSet.addRecord();
                    set.forEach((field) => {
                        record.setText(field.name.value,field.data.value);
                    })
                });

                // ADD PARAMETERS...
                var params = dymo.label.framework.createLabelWriterPrintParamsXml(printParams);
                // PRINT LABEL - PRINTER, PARAMS, LABEL...
                label.print(dymoPrinter, params, labelSet);
                
                // LABELS ARE PRINTING...
                alert('Your labels should be printing.');
            }
            catch(e)
            {
                alert(e.message || e);
            }
        }
    }

    function initTests()
	{
		if(dymo.label.framework.init)
		{
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
        
}());