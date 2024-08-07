<?php include('../config/constants.php'); ?>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
  
  <div class="login">
  	<h2 class="text-center">Login Credentials</h2>
    <br><br>
    
    <?php 

   if (isset($_SESSION['login1'])) 
   {
   	  echo $_SESSION['login1'];
   	  unset($_SESSION['login1']);  
   }
   

   if (isset($_SESSION['no-login-message'])) 
   {
      echo $_SESSION['no-login-message'];
      unset($_SESSION['no-login-message']);  
   }

    ?>

    <br>



  	<!--log in form starts here-->
    <form action="" method="POST" class="text-center">
    	Username: <br>
    	<input type="text" name="username" placeholder="Enter Username"><br><br>
    	Password:<br> 
    	<input type="password" name="password" placeholder="Enter Password"><br>
        <br>
    	<input type="submit" name="submit" value="Login" class="btn-primary">
    	<br><br>
    	
    </form>

  	<!--log in form ends here-->



  	<p class="text-center">Created By - <a href="">Jojo</a></p>
  	
  </div>

</body>
</html>


<?php 


//check whether login button is clicked or not
if (isset($_POST['submit'])) 
{
	//process for login
	//1. get the data from Login Form
	 $username = $_POST['username'];
     $password = md5($_POST['password']);

	//2. sql to check whether the username and password exists or not.
     $sql ="SELECT * FROM tbl_admins WHERE username='$username' AND password='$password'";


     //3. execute the query
     $res = mysqli_query($conn,$sql);

     //4. count rows to check whether the user exists or not
     $count = mysqli_num_rows($res);

     if($count==1)
     {
        //user available and log in success
        $_SESSION['login1'] = "<div class='success'>Login Successfull.</div>";
        $_SESSION['user1'] = $username; //check whether user is logged in or not and logout will unset it
        //redirect to dashboard
        header('location:'.SITEURL.'admin/');
     }
     else
     {
     	//user not available and log in error
     	$_SESSION['login1'] = "<div class='error text-center'>Username or Password did not match.</div>";
        //redirect to dashboard
        header('location:'.SITEURL.'admin/login.php');
     }

}



?>