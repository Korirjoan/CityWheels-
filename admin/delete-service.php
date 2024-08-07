<?php
 //include constants file
 include('../config/constants.php'); 
 
  //echo "Delete";
//check whether the id and image name is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
	//get the value and delete
	//echo "get value and delete";
	$id = $_GET['id'];
	$image_name = $_GET['image_name'];


	//remove the physical image if available
	if($image_name != "")
	{
		//image is available. So remove it
		$path = "../images/service/".$image_name;
		//remove the image
		$remove = unlink($path);

		//if failed to remove image then add an error message and stop the process
		if($remove=false) 
		{
			//set the session message
			$_SESSION['remove'] = "<div class='error'>Failed to remove Service image</div>";
			//redirect to manage service page
			header('location:'.'admin/manage-services.php');
			//stop the process
			die();
		}

	}


	//delete data from database
	//sql query to delete data from database
	$sql = "DELETE FROM tbl_services WHERE id=$id";

	//execute the query
	$res = mysqli_query($conn, $sql);

	//check whether data is deleted in database or not
	if($res=true)
	{
		//set success message and redirect
		$_SESSION['delete'] = "<div class='success'>Service Deleted Successfully.</div>";
		//redirect to manage service
		header('location:'.SITEURL.'admin/manage-services.php');
	}
	else
	{
		//set fail message and redirect
		$_SESSION['delete'] = "<div class='error'>Failed to Delete Service.</div>";
		//redirect to manage service
		header('location:'.SITEURL.'admin/manage-services.php');
	}



	//redirect to manage services page with message

}
else
{
	//redirect to manage service page
	header('location:'.SITEURL.'admin/manage-services.php');
}


?>