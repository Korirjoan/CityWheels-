<?php 
	//include constants
     include('../config/constants.php');

	//echo "delete";
    if(isset($_GET['id']) && isset($_GET['image_name'])) //either use and or &&
    {
    	//process to delete
    	//echo "process to delete";

    	//1 get id and image name 
    	$id = $_GET['id'];
    	$image_name = $_GET['image_name'];

    	//2remove the image if available
    	//check whether image is available or not and delete only if available
    	if($image_name !="")
    	{
    		//it has image and needs to remove from folder
    		//get the image path
    		$path = "../images/cars/".$image_name;

    		//remove image file from folder
    		$remove = unlink($path);


    		//check whether image is removed or not
    		if($remove==false)
    		{
    			//failed to remove image
    			$_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
    			//redirect to manage car
    			header('location:'.SITEURL.'admin/manage-cars.php');
    			//stop the process
    			die();
    		}
    	}


    	//3 delete food from database
    	$sql = "DELETE FROM tbl_car WHERE id=$id";
    	//execute the query
    	$res = mysqli_query($conn, $sql);

    	//check whether the query is executed or not and set the session message respectively
    	//4 redirect to manage car with session message
    	if($res==true)
    	{
    		//vehicle deleted
    		$_SESSION['delete'] = "<div class='success'>Vehicle Deleted Scuccessfully.</div>";
    		header('location:'.SITEURL.'admin/manage-cars.php');

    	}
    	else
    	{
    		//Failed to delete vehicle
    		$_SESSION['delete'] = "<div class='error'>Failed to Delete Vehicle.</div>";
    		header('location:'.SITEURL.'admin/manage-cars.php');
    	}


    }
    else
    {
    	//redirect to manage car page
    	//echo "redirect";
    	$_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access!!.</div>";
    	header('location:'.SITEURL.'admin/manage-cars.php');
    }


?>