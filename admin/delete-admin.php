<?php 
   
   //include constants file
   include('../config/constants.php');
  
  //1. get the id of admin to be deleted
   $id = $_GET['id'];
  
  //2. create the sql query to dekete admin
   $sql = "DELETE FROM tbl_admins WHERE id= $id";

   //execute the query
   $res = mysqli_query($conn, $sql);

   //check whether the query is executed succesfully or not
   if($res==true)
   {
   	 //query executed successfully and admin deleted
   	 //echo "admin deleted";

   	 //create seassion variable to display message
   	$_SESSION['delete'] = "<div class='success'> Admin Deleted Successfully.</div>";
   	//redirect to manage admin page
   	header('location:'.SITEURL.'admin/manage-admin.php');
   }
   else
   {
   	 //failed to delete admin
   	//echo "Failed to delete admin";
   	//create seassion variable to display message
   	$_SESSION['delete'] = "<div class='error'> Failed to Delete Admin.</div>";
   	//redirect to manage admin page
   	header('location:'.SITEURL.'admin/manage-admin.php');
   }

  //3. redirect to manage admin page


?>