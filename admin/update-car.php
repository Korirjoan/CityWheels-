<?php include('constants/navbar.php'); ?>


	<?php
	 //check whether id is set or not
	 if(isset($_GET['id']))
	 {
	 	//get all the details
	 	$id = $_GET['id'];

	 	//sql query to get the selected vehicle
	 	$sql2 = "SELECT * FROM tbl_car WHERE id=$id";

	 	//execute the query
	 	$res2 = mysqli_query($conn, $sql2);

	 	//get the value based on query executed
	 	$row2 = mysqli_fetch_assoc($res2);

	 	//get the individual values of selected food
	 	$tittle = $row2['tittle'];
	 	$passengers = $row2['passengers'];
	 	$details = $row2['details'];
	 	$current_image = $row2['image_name'];
	 	$current_category = $row2['category_id'];
	 	$featured = $row2['featured'];
	 	$active = $row2['active'];



	 }
	 else
	 {
	 	//redirect to manage cars
	 	header('location:'.SITEURL.'admin/manage-cars.php');
	 }

	?>


	
	<div class="content">
		<div class="wrapper">
			<h2>Update Vehicle</h2>
			<br><br>

			<form action="" method="POST" enctype="multipart/form-data">

				<table class="tbl-30">
					
					<tr>
						<td>Tittle:</td>
						<td>
							<input type="text" name="tittle" value="<?php echo $tittle; ?>">
						</td>
					</tr>


					<tr>
						<td>Passengers:</td>
						<td>
							<input type="number" name="passengers" value="<?php echo $passengers; ?>">
						</td>
					</tr>


					<tr>
						<td>Details:</td>
						<td>
							<textarea name="details" cols="30" rows="5"><?php echo $details; ?></textarea>
						</td>
					</tr>


					<tr>
						<td>Current Image:</td>
						<td>
							<?php 
								if($current_image == "")
								{
									//image not available
									echo "<div class='error'>Image Not Available.</div>";

								}
								else
								{
									//image available
									?>

									<img src="<?php echo SITEURL; ?>images/cars/<?php echo $current_image; ?>" width="150px">

									<?php
								}

							?>
						</td>
					</tr>

					<tr>
						<td>Select New Image:</td>
						<td>
							<input type="file" name="image">
						</td>
					</tr>


					<tr>
						<td>Category</td>
						<td>
							<select name="category">

								<?php 
								   //query to get active categories
								   $sql = "SELECT * FROM tbl_services WHERE active='Yes'";

								   //execute the query
								   $res = mysqli_query($conn, $sql);

								   //count the rows
								   $count = mysqli_num_rows($res);

								   //check whether service is available or not
								   if($count>0)
								   {
								   	 //service available
								   	while($row=mysqli_fetch_assoc($res))
								   	{
								   		$category_tittle = $row['tittle'];
								   		$category_id = $row['id'];
								   		

								   		//echo "<option value='$category_id'>$category_tittle</option>";
								   		?>

								   		  <option <?php if($current_category==$category_id) {echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_tittle; ?></option>

								   		<?php
								   	}

								   }
								   else
								   {
								   	//service not available
								   	echo "<option value='0'>Service Not Available.</option>";
								   }
								   

								?>

							</select>
						</td>
					</tr>


					<tr>
						<td>Featured:</td>
						<td>
							<input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
							<input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No">No
						</td>
					</tr>


					<tr>
						<td>Active:</td>
						<td>
							<input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes">Yes
							<input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No">No
						</td>
					</tr>

					<tr>
						<td>
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

							<input type="submit" name="submit" value="Update Vehicle" class="btn-secondary">
						</td>
					</tr>

				</table>
				
			</form>



			<?php

				if(isset($_POST['submit']))
				{
					//echo "Button clicked";

					//1 get all the detailsfrom the form
					$id = $_POST['id'];
					$tittle = $_POST['tittle'];
					$passengers = $_POST['passengers'];
					$details = $_POST['details'];
					$current_image = $_POST['current_image'];
					$category_id = $_POST['category'];

					$featured = $_POST['featured'];
					$active = $_POST['active'];

					//2 upload the image if selected


					//check whether upload button is clicked or not
					if(isset($_FILES['image']['name']))
					{
						//upload button is clicked
						$image_name = $_FILES['image']['name']; //new image name

						//check whether the file is available or not
						if($image_name!="")
						{
							//image is available
							//A. Uploading new image
							//rename the image
							$ext = end(explode('.', $image_name)); //get the extension of the image

							$image_name = "Car-".rand(0000, 9999).'.'.$ext; //renaming new image

							//get the source path and destination path
							$src_path = $_FILES['image']['tmp_name']; //source path
							$dest_path = "../images/cars/".$image_name; //destination path

							//upload the image
							$upload = move_uploaded_file($src_path, $dest_path);

							//check whether image is uploaded or not 
							if($upload==false)
							{
								//failed to
								$_SESSION['upload'] = "<div class='error'>Failed to Upload New image</div>";
								//redirect to manage cars
								header('location:'.SITEURL.'admin/manage-cars.php');
								//stop the process
								die();

							}
							//3 remove the image if new image is uploaded and current image exists
							//B. remove current image if available
							if($current_image!="")
							{
								//current image is available
								//remove the image
								$remove_path = "../images/cars".$current_image;

								$remove = unlink($remove_path);


								//check whether the image is removed or not
								if(remove==false)
								{
									//failed to remove current image
									$_SESSION['remove-failed'] = "<div class='error'>Failed to Remove Current Image.</div>";
									//redirect to manage car
									header('location:'.SITEURL.'admin/manage-cars.php');
									//stop the process
									die();
								}
							}
						}
						else
						{
							$image_name = $current_image; //default image when image is not selected
						}
					}
					else
					{
						$image_name = $current_image; //default image when image button is not cliked
					}

					

					//4 update the vehicle in the database
					$sql3 = "UPDATE tbl_car SET
						tittle = '$tittle',
						passengers = $passengers,
						details = '$details',
						image_name = '$image_name',
						category_id = '$category',
						featured = '$featured',
						active = '$active'

						WHERE id=$id

					";


					//execute the sql query
					$res3 = mysqli_query($conn, $sql3);

					//check whether the query is executed or not
					if($re3=true)
					{
						//query executed and food updated
						$_SESSION['update'] = "<div class='success'>Vehicle Updated Successfully.</div>";
						header('location:'.SITEURL.'admin/manage-cars.php');
					}
					else
					{
						//failed to update food
						$_SESSION['update'] = "<div class='error'>Failed to Update Vehicle.</div>";
						header('location:'.SITEURL.'admin/manage-cars.php');
					}

					
				}

			?>


			
		</div>
		
	</div>

<?php include('constants/footer.php'); ?>


