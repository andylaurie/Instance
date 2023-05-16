(function() {
    // ON PAGE LOAD...
    function onload() {
        // LABEL ELEMENTS...
        var modelNumber = document.getElementById('modelNumber');
        var productCode = document.getElementById('productCode');
        var descriptionTop = document.getElementById('descriptionTop');
        var descriptionBottom = document.getElementById('descriptionBottom');
        var supplyVoltage = document.getElementById('supplyVoltage');
        var ratedInput = document.getElementById('ratedInput');
        var serialDesignation = document.getElementById('serialDesignation');
        var serialWidth = document.getElementById('serialWidth');
        var packedWeight = document.getElementById('packedWeight');
        var brand = document.getElementById('brand');

        // INPUT PARAMETERS...
        var printButton = document.getElementById('print');
        var serialNumber = document.getElementById('serialNumber');
        var qtyNum = document.getElementById('qty');

        // FILE LOCATIONS...
        var machineUpper = svrAdd + "Instance/assets/labels/machines/machineUpper.xml";
        var machineLowerSD = svrAdd + "Instance/assets/labels/machines/machineLowerSD.xml";
        var machineLowerDD = svrAdd + "Instance/assets/labels/machines/machineLowerDD.xml";

        // PRINT OPTIONS...
        var printParams = {};
        printParams.printQuality = 'Text';
        printParams.copies = 1;

        // ON PRINT BUTTON PRESS...
        printButton.onclick = function()
        {
            try
            {
                // FORMAT TYPES AND GET DATA...
                serialWidth = parseFloat(serialWidth.value);
                qtyNum = parseFloat(qtyNum.value);
                serialNumber = serialNumber.value;
                serialDesignation = serialDesignation.value;
                // GET LOGO...
                brand = brand.value;
                var logo = brand.toLowerCase();
                // BUILD LABEL...
                xhttp=new XMLHttpRequest();
                xhttp.open("GET", machineUpper ,false);
                xhttp.send();
                var labelUpper = xhttp.responseText;
                xhttp=new XMLHttpRequest();
                xhttp.open("GET", svrAdd + "Instance/assets/labels/machines/logos/" + logo + ".xml" ,false);
                xhttp.send();
                var labelLogo = xhttp.responseText;
                xhttp=new XMLHttpRequest();
                if (descriptionBottom.innerHTML == '') {
                    xhttp.open("GET", machineLowerSD ,false);
                } else {
                    xhttp.open("GET", machineLowerDD ,false);
                }
                xhttp.send();
                var labelLower = xhttp.responseText;
                // OPEN LABEL...
                var labelXML = labelUpper + labelLogo + labelLower;
                var label = dymo.label.framework.openLabelXml(labelXML);
                // CREATE LABEL SET...
                var labelSet = new dymo.label.framework.LabelSetBuilder();
                // ADD DATA...
                var i = 0;
                do {
                    ++i;
                    var record = labelSet.addRecord();
                    record.setText('modelNumber', modelNumber.innerHTML);
                    record.setText('descriptionTop', descriptionTop.innerHTML);
                    if (descriptionBottom.innerHTML !== '') {
                        record.setText('descriptionBottom', descriptionBottom.innerHTML);
                    }
                    record.setText('supplyVoltage', supplyVoltage.value);
                    record.setText('ratedInput', ratedInput.value);
                    // FORMAT SERIAL NUMBER...
                    while (serialNumber.length < serialWidth) serialNumber = "0" + serialNumber;
                    record.setText('serialNumber', serialDesignation + serialNumber);
                    record.setText('packedWeight', packedWeight.value + 'kg');
                    // INCREMENT SERIAL NUMBER EVERY 2...
                    if (i % 2 === 0) {
                        serialNumber++;
                        serialNumber = serialNumber.toString();
                    }
                }
                while (i < (qtyNum * 2));

                // ADD PARAMETERS...
                var params = dymo.label.framework.createLabelWriterPrintParamsXml(printParams);

                // PRINT LABEL - PRINTER, PARAMS, LABEL...
                label.print('DYMO LabelWriter 4XL', params, labelSet);

                // LABELS ARE PRINTING...
                alert('Your labels should be printing.');
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
