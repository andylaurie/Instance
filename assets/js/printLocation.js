(function()
{
    // called when the document completly loaded
    function onload()
    {
        var partNumberText = document.getElementById('partNumber');
        var descriptionText = document.getElementById('description');
        var rackNumberText = document.getElementById('rackNumber');
        var binNumberText = document.getElementById('binNumber');
        var boxQtyText = document.getElementById('boxQty');
        var dateRecText = document.getElementById('dateRec');
        var boxIDText = document.getElementById('boxID');
        var labelType = document.getElementById('type');
        var printButton = document.getElementById('print');

        // FILE LOCATIONS
        var path = {};
        path["locSmall"] = svrAdd + "Instance/assets/labels/locSmall.xml";
        path["locLarge"] = svrAdd + "Instance/assets/labels/locLarge.xml";

        // PRINT OPTIONS
        var printParams = {};
        printParams.printQuality = 'Text';

        // prints the label
        printButton.onclick = function()
        {
            try
            {
                if(labelType.value == "sparesSmall" || "sparesLarge") {
                    printParams.copies = document.getElementById('copies').value;
                    if(document.getElementById('copies').value == 0) {
                        alert('Please enter a number of copies');
                    }
                } else {
                    printParams.copies = 1;
                }

                // open label
                var labelXML = dymo.label.framework.openLabelFile(path[labelType.value]);
                var label = dymo.label.framework.openLabelXml(labelXML);

                // create label set to print data
                var labelSet = new dymo.label.framework.LabelSetBuilder();

                // first label
                var record = labelSet.addRecord();
                if(labelType.value == "sparesSmall" || "sparesLarge") {
                    record.setText('partNumber', partNumberText.innerHTML);
                    record.setText('description', "Description: ".concat(descriptionText.innerHTML));
                }
                if(labelType.value == "stock") {
                    record.setText('partNumber', partNumberText.value);
                    record.setText('description', descriptionText.value);
                    record.setText('boxQty', boxQtyText.value);
                    record.setText('dateRec', dateRecText.value);
                    record.setText('boxID', boxIDText.value);
                }


                //INSERTED BY ME TO GET NUMBER OF COPIES
                var params = dymo.label.framework.createLabelWriterPrintParamsXml(printParams);

                // finally print the label on PRINTER, PARAMS, LABEL
                if(labelType.value == "sparesSmall") {
                    var printer = 'DYMO LabelWriter 450 Twin Turbo';
                    printParams.twinTurboRoll = 'Left';
                } else {
                    var printer = 'DYMO LabelWriter 4XL';
                }
                label.print(printer, params, labelSet);
            }
            catch(e)
            {
                alert(e.message || e);
            }
        }
    };

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

} ());
