<?php include('constants/navbar.php'); ?>

<div class="content">
	<div class="wrapper">
		<h2>New Admin</h2>

		<br><br>


		<?php 

                if (isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; //displaying the session message
                    unset($_SESSION['add']); //Removing the sesssion message
                }


             ?>
             <br>

        <form action="" method="POST">
        	
        <table class="tbl-30">
        	<tr>
        		<td>Full name:</td>
        		<td>
        			<input type="text" name="full_name" placeholder="enter your full name">
        		</td>
        	</tr>

        	<tr>
        		<td>Username:</td>
        		<td>
        			<input type="text" name="username" placeholder="enter your username">
        		</td>
        	</tr>
            

            <tr>
        		<td>Password:</td>
        		<td>
        			<input type="password" name="password" placeholder="enter your password">
        		</td>
        	</tr>


        	<tr>
        		<td colspan="2">
        			<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
        		</td>
        	</tr>

        </table>


        </form>
		
	</div>
	
</div>


<?php include('constants/footer.php'); ?>


<?php
//process the value from form and save it in Database
// check whether the submit button is clicked

if(isset($_POST['submit']))
{
	//button clicked
	//echo "clicked";


	// get the data from form
	$full_name = $_POST['full_name'];
	$username = $_POST['username'];
	$password = md5($_POST['password']); //password encryption

	//2. SQL query to save data to database
	$sql = " INSERT INTO tbl_admins SET 
	     full_name='$full_name',
	     username='$username',
	     password='$password'
	     "; 

	     //3. executing the query and save data into database
	     $res = mysqli_query($conn, $sql) or die(mysqli_error());

	     //4. check whether the (query is executed) data is inserted or not and display appropriate message
	     if ($res==True)
	     {
	     	//Data inserted
	     	//create a session variable to display message
	     	$_SESSION['add'] = "<div class='success'> Admin Added Successfully.</div";
	     	//redirect page to manage-admin
	     	header("location:".SITEURL.'admin/manage-admin.php');
	     }
	     else
	     {
	     	//failed to insert data
	     	//create a session variable to display message
	     	$_SESSION['add'] = "<div class='error'> Failed to add Admin.</div";
	     	//redirect page to add-admin
	     	header("location:".SITEURL.'admin/add-admin.php');
	     }

}



 ?>