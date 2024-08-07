<?php include('constants/navbar.php'); ?>

	<div class="content">
		<div class="wrapper">
			<h2>Update Service</h2>

			<br><br>


            <?php 

            	//check whether the id is set or not
                if(isset($_GET['id']))
                {
                	//get the id and all other details
                	//echo "getting the data";
                	$id = $_GET['id'];
                	//create sql query to get all the other data
                	$sql="SELECT * FROM tbl_services WHERE id=$id";


                	//execute the query
                	$res = mysqli_query($conn,$sql);

                	//count the rows to check whether the id is valid or not
                	$count = mysqli_num_rows($res);

                	if($count==1)
                	{
                		//get all the data
                		$row = mysqli_fetch_assoc($res);
                		$tittle = $row['tittle'];
                		$current_image = $row['image_name'];
                		$featured = $row['featured'];
                		$active = $row['active'];
                	}
                	else
                	{
                		//redirect to manage services with session message
                		$_SESSION['no-service-found'] ="<div class='error'>Service Not Found</div>";
                		//redirect to manage service page
                		header('location:'.SITEURL.'admin/manage-services.php'); 
                	}

                }
                else
                {
                	//redirect to manage service
                	header('location:'.SITEURL.'admin/manage-services.php');
                }

            ?>



            
            <form action="" method="POST" enctype="multipart/form-data">

			<table class="tbl-30">
				<tr>
					<td>Tittle</td>
					<td>
						<input type="text" name="tittle" value="<?php echo $tittle; ?>">
					</td>
				</tr>

				<tr>
					<td>Current Image:</td>
					<td>
						
						<?php

							 if($current_image != "")
							 {
							 	//display the image
							 	?>

							 	<img src="<?php echo SITEURL; ?>images/service/<?php echo $current_image; ?>" width="150px">

							 	<?php
							 }
							 else
							 {
							 	//display message
							 	echo "<div class='error'>Image not Added.</div>";
							 }

						?>


					</td>
				</tr>

				<tr>
					<td>New Image:</td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Featured:</td>
					<td>
						<input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes

						<input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
					</td>
				</tr>


				<tr>
					<td>Active:</td>
					<td>
						<input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
						<input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
					</td>
				</tr>


				<tr>
					<td>
					<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="submit" name="submit" value="Update Service" class="btn-secondary">
					</td>
				</tr>
				
			</table>
		</form>


		<?php 

			if(isset($_POST['submit']))
			{
				//echo "Clicked";
				//1. get all the value from our form
				$id = $_POST['id'];
				$tittle = $_POST['tittle'];
				$current_image = $_POST['current_image'];
				$featured = $_POST['featured'];
				$active = $_POST['active'];


				//2. updating new image if selected
				//check whether the image is selected or not
				if(isset($_FILES['image']['name']))
				{
					//get the image details
					$image_name = $_FILES['image']['name'];

					//check whether the image is available or not
					if($image_name !="")
					{
						//image available
						//A.upload the new image
                        

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
				        		header('location:'.SITEURL.'admin/manage-services.php');
				        		//stop the process
				        		die();
			        	    }



						//B. remove the current image if available
			        	    if($current_image!="")
			        	    {
			        	      $remove_path ="../images/service/".$current_image;

				        	    $remove = unlink($remove_path);

				        	    //check whether the image is removed or not
				        	    //if failed to remove then display message and stop the process
				        	    if($remove==false)
				        	    {
				        	    	//failed to remove image
				        	    	$_SESSION['failed-remove'] ="<div class='error'>Failed to Remove Current Image.</div>";
				        	    	header('location:'.SITEURL.'admin/manage-services.php');
				        	    	die(); //stop the process
				        	    }	
			        	    }
			        	    
					}
					else
					{
						$image_name = $current_image;
					}
				}
				else
				{
					$image_name = $current_image;
				}

				//3. update the database
				$sql2 ="UPDATE tbl_services SET
				   tittle = '$tittle',
				   image_name = '$image_name',
				   featured = '$featured',
				   active = '$active'
				   WHERE id=$id

				";

				//execute the query
				$res2 = mysqli_query($conn, $sql2);


				//4. redirect to manage service with message
				//check whether query is executed or not
				if(res2==true)
				{
					//service updated
					$_SESSION['update'] = "<div class='success'>Service Updated Successfully.</div>";
					header('location:'.SITEURL.'admin/manage-services.php');
				}
				else
				{
					//failed to update service
					$_SESSION['update'] = "<div class='error'>Failed to Update Service.</div>";
					header('location:'.SITEURL.'admin/manage-services.php');
				}



			}


		?>



			
		</div>
		
	</div>



<?php include('constants/footer.php'); ?>