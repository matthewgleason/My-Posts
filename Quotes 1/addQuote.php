<!-- 
Add a quote to the database. 

File name addQuote.php 
    
Authors: Matt Gleason
-->

<!DOCTYPE html>
<html>
<head>
<title>Add Quote</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<h3>Add a Quote</h3>

<div class='quoteContainer' >
<form action="controller.php" method='post'>
<textarea id='quote' name='quote' class='textQuote'></textarea>
<input id='author' name='author' class='subButton'><br><br>
<input class='subButton' type='submit' value='Add Quote'>
</form>
</div>

</body>
</html>