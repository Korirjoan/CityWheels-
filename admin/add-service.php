<?php include('constants/navbar.php'); ?>

<div class="content">
	<div class="wrapper">
		<h2>Add Service</h2>
		<br><br>


        <?php 

         if(isset($_SESSION['add']))
         {
         	echo $_SESSION['add'];
         	unset($_SESSION['add']);
         }

         if(isset($_SESSION['upload']))
         {
         	echo $_SESSION['upload'];
         	unset($_SESSION['upload']);
         }

        ?>

        <br><br>

		<!--Add service form starts-->
		<form action="" method="POST" enctype="multipart/form-data">

			<table class="tbl-30">
				<tr>
					<td>Tittle</td>
					<td>
						<input type="text" name="tittle" placeholder=" Service Tittle">
					</td>
				</tr>

                <tr>
                	<td>Select Image:</td>
                	<td>
                		<input type="file" name="image">
                	</td>
                </tr>


				<tr>
					<td>Featured: </td>
					<td>
						<input type="radio" name="featured" value="Yes">Yes
						<input type="radio" name="featured" value="No">No
					</td>
				</tr>


				<tr>
					<td>Active: </td>
					<td>
						<input type="radio" name="active" value="Yes">Yes
						<input type="radio" name="active" value="No">No
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Service" class="btn-secondary">
						
					</td>
				</tr>
				
			</table>
			
		</form>



		<!--Add service form ends-->

       <?php 
       
       //check whether submit button is clicked or not
       if(isset($_POST['submit']))
       {
       	//echo "clicked";

       	//1. get the value from service form
       	$tittle = $_POST['tittle'];

       	//for radio input, we need to check whether the button is selected or not
       	if(isset($_POST['featured']))
       	{
       		//get the value from form
       		$featured = $_POST['featured'];

       	}
       	else
       	{
       		//set the default value
       		$featured = "No"; 
       	}
        

        if(isset($_POST['active']))
        {
        	$active = $_POST['active'];
        }
        else
        {
        	$active = "No";
        }


        //check whether the image is selected or not and set the value for image name accordingly
        //print_r($_FILES['image']);

        //die(); //break the code

        if(isset($_FILES['image']['name']))
        {
        	//upload the image
        	//to upload image we need imagename, sourcepath and destination
        	$image_name = $_FILES['image']['name'];

        	//upload the image only if image is selected
          if($image_name != "")
          {



	        	//Auto rename our image
	        	//get the extension of our Image (jpg, png, gif, etc)
	        	$ext = end(explode('.', $image_name));


	        	//rename the image
	        	$image_name ="service-".rand(000,999).'.'.$ext; //new image name e.g service-001.jpg



	        	$source_path = $_FILES['image']['tmp_name'];

	        	$destination_path = "../images/service/".$image_name;


	        	//upload the image
	        	$upload = move_uploaded_file($source_path, $destination_path);

	        	//check whether image is uploaded or not
	        	//and if the image is not uploaded then we  will stop and redirect with error message
	        	if($upload=false)
	        	{
	        		//set message
	        		$_SESSION['upload'] = "<div class='error'>Failed to upload Image</div>";
	        		//redirect to add service page
	        		header('location:'.SITEURL.'admin/add-service.php');
	        		//stop the process
	        		die();
        	  }
          }
        }
        else
        {
        	//dont upload image and set the image name value as blank
        	$image_name="";
        }



          //2. cerate sql query to insert service into database
        $sql = "INSERT INTO tbl_services SET 
           tittle = '$tittle',
           image_name = '$image_name',
           featured = '$featured',
           active = '$active'
        ";


        //3. execute the query and save in database
        $res = mysqli_query($conn, $sql);

        //4. check whether the query is executed or not and data added or not
        if($res=true)
        {
        	//query executed and service added
        	$_SESSION['add'] = "<div class='success'>Service Added Successfully.</div>";
        	//redirect to manage service page
        	header('location:'.SITEURL.'admin/manage-services.php');
        }
        else
        {
        	//failed to add service
        	$_SESSION['add'] = "<div class='error'>Failed to Add Service.</div>";
        	//redirect to manage service page
        	header('location:'.SITEURL.'admin/add-service.php');
        }
       

       }




       ?>


		
	</div>
	
</div>



<?php include('constants/footer.php'); ?>