<?php
   //Authorization acces control
   //check whether the user is logged in or not
   if(!isset($_SESSION['user'])) //if user session is not set
   {
      //user is not logged in
      //redirect to log in page with message
      $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login to Proceed</div>";
      //redirect to login page
      header('location:'.SITEURL.'./login.php'); 
   }

 ?>

