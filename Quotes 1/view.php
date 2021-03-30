<!-- 
This is the home page for Final Project, Quotation Service. 
It is a PHP file because later on you will add PHP code to this file.

File name quotes.php 
    
Authors: Rick Mercer and Matt Gleason
-->

<!DOCTYPE html>
<html>
<head>
<title>Quotation Service</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body onload="showQuotes()">

<h1>Quotation Service</h1>


<div id="quotes"></div>

<script>
var element = document.getElementById("quotes");
function showQuotes() {
	//alert('view.php under construction');
    // TODO 5: 
    // Complete this function using an AJAX call to controller.php
  	// You will need query parameter todo=getQuotes.
  	// Echo back one big string to here that has all styled quotations.
  	// Write all of the complex code to layout the array of quotes 
  	// inside function getQuotesAsHTML inside controller.php.
  	var ajax = new XMLHttpRequest();
	ajax.open('GET', 'controller.php?command=getQuotes', true);
	ajax.send()
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200) {
			element.innerHTML = ajax.responseText;
		}
	};
  	

} // End function showQuotes

</script>

</body>
</html>