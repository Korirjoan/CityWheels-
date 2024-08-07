<?php include('constants/navbar.php'); ?>

<div class="content" >
	<div class="wrapper">
		<h2>Update Admin</h2>

		<br><br>

		<?php

          //1. get the id of selected admin
		  $id=$_GET['id'];

          //2. create sql query to get the data
          $sql="SELECT * FROM tbl_admins WHERE id=$id";

          //Execute the query
          $res=mysqli_query($conn, $sql);

          //check whether the query is executed
          if($res==true)
          {
          	//check whether the data is available or not
          	$count = mysqli_num_rows($res);
          	// check whether we have admin data or not
          	if($count==1)
          	{
          		//get the details
          		//echo "Admin Available";
          		$row=mysqli_fetch_assoc($res);

          		 $full_name = $row['full_name'];
          		 $username = $row['username'];

          	}
          	else
          	{
          		//redirect to manage admin page
          		header('location'.SITEURL.'admin/manage-admin.php');
          	}

          }

		 ?>
		
        <form action="" method="POST">

            <table class="tbl-30">
            	<tr>
            		<td>Full Name:</td>
            		<td>
            			<input type="text" name="full_name" value="<?php echo $full_name; ?>">
            		</td>
            	</tr>

                <tr>
            		<td>Username:</td>
            		<td>
            			<input type="text" name="username" value="<?php echo $username; ?>">
            		</td>
            	</tr>

            	<tr>
            		<td colspan="2">
            			<input type="hidden" name="id" value="<?php echo $id; ?>">
            			<input type="submit" name="submit" value="Update Admin" class="btn-secondary">
            		</td>
            	</tr>

            </table>
        	
        </form>

	</div>
	
</div>


<?php 

   //check whether submit button is clicked
   if(isset($_POST['submit']))
   {
   	 //echo "Button Clicked";
   	 //get all the values from orm to update
   	 $id = $_POST['id'];
   	 $full_name = $_POST['full_name'];
   	 $username = $_POST['username'];

     //create a sql query to update admin
     $sql = "UPDATE tbl_admins SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id='$id'
     ";

     //execute the query
     $res = mysqli_query($conn, $sql);

     //check whether the query is executed succesfully
     if($res==true)
     {
        //query executed and admin updated
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
        //redirect to manage admin page.
        header('location:'.SITEURL.'admin/manage-admin.php');

     }
     else
     {
        //failed to update admin
        $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
        //redirect to manage admin page.
        header('location:'.SITEURL.'admin/manage-admin.php');
     }

   }


?>


<?php include('constants/footer.php'); ?>