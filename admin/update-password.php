<?php include('constants/navbar.php'); ?>
 
 <div class="content">
 	<div class="wrapper">
 		<h2>Change Password</h2>
 		<br><br>


        <?php

        if(isset($_GET['id']))
        {
        	$id=$_GET['id'];
        }


         ?>


 		<form action="" method="POST">

 			<table class="tbl-30">
 				<tr>
 					<td>Current Password:</td>
 					<td>
 						<input type="password" name="current_password" placeholder="Enter your Current Password">
 					</td>
 				</tr>


 				<tr>
 					<td>New Password:</td>
 					<td>
 						<input type="password" name="new_password" placeholder="Enter your new Password">
 					</td>
 				</tr>


 				<tr>
 					<td>Confirm Password:</td>
 					<td>
 						<input type="password" name="confirm_password" placeholder="Confirm Password">
 					</td>
 				</tr>

 				<tr>
 					<td colspan="2">
 						<input type="hidden" name="id" value="<?php echo $id; ?>">
 						<input type="submit" name="submit" value="Change Password" class="btn-secondary">
 						
 					</td>
 				</tr>
 				
 			</table>
 			
 		</form>
 		
 	</div>
 	
 </div>



 <?php 
 
   //check whether the submit button is clicked
   if(isset($_POST['submit']))
   {
   	  //echo "clicked";

   	  //1. Get the data from form
      $id=$_POST['id'];
      $current_password=md5($_POST['current_password']);
      $new_password=md5($_POST['current_password']);
      $confirm_password=md5($_POST['confirm_password']);

   	  //2. check whether the user with current id and current password exists or not
      $sql = "SELECT * FROM tbl_admins WHERE id=$id AND password='$current_password'";

      //execute the query
      $res = mysqli_query($conn, $sql);

      if($res==true)
      {
        //check whether data is available or not
        $count=mysqli_num_rows($res);


        if($count==1)
        {
          //user exists and password can be changed

          //check whether the new password and confirm password match or not
          if($new_password=$confirm_password)
          {
            //update the password
            $sql2 = "UPDATE tbl_admins SET
               password='$new_password' 
               WHERE id=$id
            ";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);

            //check whether the query is executed or not
            if(res2==true)
            {
              //display success message
              $_SESSION['change-pwd'] = "<div class='success'>Password Changed Succesfully.</div>";
              //redirect to manage admin page
              header('location:'.SITEURL.'admin/manage-admin.php');


            }
            else
            {
              //display error message
              $_SESSION['change-pwd'] = "<div class='error'>Failed to change Password.</div>";
              //redirect to manage admin page
              header('location:'.SITEURL.'admin/manage-admin.php');
            }
          }
          else
          {
            $_SESSION['pwd-not-match'] = "<div class='error'>Password Does Not Match.</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');

          }


        }
        else
        {
          //user does not exist set message and redirect
          $_SESSION['user-not-found'] = "<div class='error'>User Does Not Exist.</div>";
          //redirect to manage admin
          header('location:'.SITEURL.'admin/manage-admin.php');
        }


      }

   	  //3. check whether the new password and confirm password match

   	  //4. change password if all above is true
   }

 ?>

<?php include('constants/footer.php'); ?>