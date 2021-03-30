<!-- 
Logs user in.

File name addQuote.php 
    
Authors: Rick Mercer and Matt Gleason
-->

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<h3>Login</h3>
<?php 
  // seesion_start()s are not needed until later, certainly not in Quotes 1
  session_start();
?>

<form autocomplete="off"  action="controller.php" method="post">
<div class="registerContainer">
<input type="text" name="loginUsername" placeholder='Username' required>
<br>
<input type="text" name="loginPassword" placeholder='Password' required>
<br><br>
<input type="submit" value="Login"> <br>
<?php 
// This is not needed in Quotations 1.  This code will be needed to show
// errors later in a multi-page website when an account nme already exists.
if( isset($_SESSION ['registrationError']))
  echo $_SESSION ['registrationError']; 
unset($_SESSION ['registrationError']);
?>
</div>
</form>

</body>
</html>