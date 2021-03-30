
<?php 
  // Matthew Gleason
  // seesion_start()s are not needed until later, certainly not in Quotes 1
  session_start();
  
  unset($_SESSION['user']);
  
  header("Location: view.php");
?>


