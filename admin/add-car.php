<?php include('constants/navbar.php'); ?>

	<div class="content">
		<div class="wrapper">
			<h2>Add New Car</h2>

			<br><br>


			<?php 

			  if(isset($_SESSION['upload']))
			  {
			  	echo $_SESSION['upload'];
			  	unset($_SESSION['upload']);
			  }


			?>


			<form action="" method="POST" enctype="multipart/form-data">

				<table class="tbl-30">

					<tr>
						<td>Tittle:</td>
						<td>
							<input type="text" name="tittle" placeholder="Car Tittle">
						</td>
					</tr>


					<tr>
						<td>Max Passengers:</td>
						<td>
							<input type="number" name="passengers">
						</td>
					</tr>


					<tr>
						<td>Details</td>
						<td>
							<textarea name="details" cols="30" rows="5" placeholder="Current Location"></textarea>
						</td>
					</tr>


					<tr>
						<td>Select Image:</td>
						<td>
							<input type="file" name="image">
						</td>
					</tr>

					<tr>
						<td>Category:</td>
						<td>
							<select name="category">


								<?php 

								   //create php code to display services from database
								   //1. create sql to get all active services
								   $sql = "SELECT * FROM tbl_services WHERE active='Yes'";

								   //executing query
								   $res = mysqli_query($conn, $sql);

								   //count rows to check whether we have services or not
								   $count = mysqli_num_rows($res);

								   //if count is greater than zero, we have services else we do not have services
								   if($count>0)
								   {
								   	//we have services
								   	  while($row=mysqli_fetch_assoc($res))
								   	  {
								   	  	//get details of service
								   	  	$id = $row['id'];
								   	  	$tittle = $row['tittle'];


								   	  	?>

								   	  	   <option value="<?php echo $id; ?>"><?php echo $tittle; ?></option>

								   	  	<?php
								   	  }
								   }
								   else
								   {
								   	//we do not have services
								   	?>

								   	  <option value="0">No Categories Found</option>

								   	<?php
								   }

								   //2.display on dropdown

								?>

							</select>
						
					</tr>

					<tr>
						<td>Featured:</td>
						<td>
							<input type="radio" name="featured" value="Yes">Yes
							<input type="radio" name="featured" value="No">No
						</td>
					</tr>


					<tr>
						<td>Active:</td>
						<td>
							<input type="radio" name="active" value="Yes">Yes
							<input type="radio" name="active" value="No">No
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add car" class="btn-secondary">
						</td>
					</tr>
					
				</table>
				
			</form>



			<?php 

			   //check whether the button is clicked or not
			if (isset($_POST['submit']))
			{
				//add car into database
				//echo "Clicked";

				//1. get the data from form
				$tittle = $_POST['tittle'];
				$passengers = $_POST['passengers'];
				$details = $_POST['details'];
				$category = $_POST['category'];

				//check whether radio button for featured and active are checked or not
				if(isset($_POST['featured']))
				{
					$featured = $_POST['featured'];
				}
				else
				{
					$featured = "Yes"; //setting the default value
				}


				if(isset($_POST['active']))
				{
					$active = $_POST['active'];
				}
				else
				{
					$active = "No"; //setting default value
				}

				//2. upload the image if selected
				//check whether the select image is clicked or not and upload the image only if the image is selected
				if(isset($_FILES['image']['name']))
				{
					//get the details of the selected image
					$image_name = $_FILES['image']['name'];

					//check whether the image is selected or not and upload image only if selected
					if($image_name!="")
					{
						//image is selected
						//A. Rename the image
						//get the extension of selected image (jpg, png, gif)
						$ext = end(explode('.', $image_name));

						//cretae new name for image
						$image_name = "Car-".rand(0000,9999).".".$ext; //new image name Car-8989.jpg

						//B. upload the image
						//get the source path and destination path

						 //Source path is the current location of the image
						$src = $_FILES['image']['tmp_name'];

						//get the destination path for image to be uploaded
						$dst = "../images/cars/".$image_name;

						//Finally upload the car image
						$upload = move_uploaded_file($src, $dst);


						//check whether image is uploaded or not
						if($upload==false)
						{
							//failed to upload  image
							//redirect to add service page with error message
							$_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
							header('location:'.SITEURL.'admin/add-service.php');
							//stop the process
							die();
						}

					}

				}
				else
				{
					$image_name = ""; //setting default value as blank
				}

				//3. inert into database


				//create sql query to save our add car
				//for numerical value we do not need to pass value inside quote'' but for string value its compulsory to add quotes
				$sql2 = "INSERT INTO tbl_car SET 
				  tittle = '$tittle',
				  passengers = $passengers,
				  details = '$details',
				  image_name = '$image_name',
				  category_id = $category,
				  featured= '$featured',
				  active= '$active'

				";


				//execute the query
				$res2 = mysqli_query($conn, $sql2);

				//check whether data inserted or not
				//4. redirect with message to manage service page


				if($res2==true)
				{
					//data inserted successfully
					$_SESSION['add'] = "<div class='success'>Car Added Successfully.</div>";
					header('location:'.SITEURL.'admin/manage-cars.php');
				}
				else
				{
					//failed to add data
					$_SESSION['add'] = "<div class='error'>Failed to add Car.</div>";
					header('location:'.SITEURL.'admin/manage-cars.php');
				}

				
			}


			?>


			
		</div>
		
	</div>



<?php include('constants/footer.php'); ?>