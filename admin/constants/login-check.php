<?php
   //Authorization acces control
   //check whether the user is logged in or not
   if(!isset($_SESSION['user1'])) //if user session is not set
   {
      //user is not logged in
      //redirect to log in page with message
      $_SESSION['no-login-message'] = "<div class='error'>Please Login to Access Admin panel</div>";
      //redirect to login page
      header('location:'.SITEURL.'admin/login.php'); 
   }

 ?>


