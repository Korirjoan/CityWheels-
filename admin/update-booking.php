 <?php include('constants/navbar.php'); ?>

 	<div class="content">
 		<div class="wrapper">
 			<h2>Update Bookings</h2>
 			<br><br>

 			<?php 

 				//check whether id is set ir not
 			    if(isset($_GET['id']))
 			    {
 			    	//get the booking details
 			    	$id = $_GET['id'];

 			    	//get all the details based on id
 			    	//sql to get the booking values
 			    	$sql = "SELECT * FROM tbl_book WHERE id=$id";
 			    	//execute the query
 			    	$res = mysqli_query($conn, $sql);
 			    	//count rows
 			    	$count = mysqli_num_rows($res);


 			    	//check whether we have data
 			    	if($count==1)
 			    	{
 			    		//details available
 			    		$row=mysqli_fetch_assoc($res);

 			    		//get all the details
 			    		$car = $row['car'];
 			    		$passengers = $row['passengers'];
 			    		$pickup = $row['pickup'];
 			    		$destination = $row['destination'];
 			    		$status = $row['status'];
 			    	}
 			    	else
 			    	{
 			    		//details not available
 			    		//redirect to manage order
 			    		header('location:'.SITEURL.'admin/manage-booking.php');
 			    	}

 			    }
 			    else
 			    {
 			    	//redirect to manage booking
 			    	header('location:'.SITEURL.'admin/manage-booking.php');
 			    }

 			?>


 			<form action="" method="POST">

 				<table class="tbl-30">

 					<tr>
 						<td>Vehicle Name:</td>
 						<td>
 							<b><?php echo $car; ?></b> 
 						</td>
 					</tr>

 					<tr>
 						<td>Passengers:</td>
 						<td>
 							<?php echo $passengers; ?>
 						</td>
 					</tr>

 					<tr>
 						<td>Pickup:</td>
 						<td>
 						<input type="text" name="pickup" value="<?php echo $pickup; ?>">
 					   </td>
 					</tr>

 					<tr>
 						<td>Destination:</td>
 						<td>
 						<input type="text" name="destination" value="<?php echo $destination; ?>">
 					   </td>
 					</tr>

 					<tr>
 						<td>Status</td>
 						<td>
 							<select name="status">
 								<option <?php if($status=="Booked"){echo "selected";} ?> value="Booked">Booked</option>
 								<option <?php if($status=="Boarded"){echo "selected";} ?> value="Boarded">Boarded</option>
 								<option <?php if($status=="Alighted"){echo "selected";} ?> value="Alighted">Alighted</option>
 								<option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
 							</select>
 						</td>
 					</tr>

 					<tr>
 						<td colspan="2">
 							<input type="hidden" name="id" value="<?php echo $id; ?>">
 							<input type="hidden" name="passengers" value="<?php echo $passengers; ?>">
 							<input type="submit" name="submit" value="Update Booking" class="btn-secondary">
 							
 						</td>
 					</tr>

 					
 					
 				</table>
 				
 			</form>
            

            <?php

            	//check whethet update button is clicked
            if(isset($_POST['submit']))
            {
            	//echo "clicked";
            	//get all the values from form
            	$id = $_POST['id'];
            	$car = $_POST['car'];
            	$passengers = $_POST['passengers'];
            	$pickup = $_POST['pickup'];
            	$destination = $_POST['destination'];
            	$total = $passengers * 15;
            	$status = $_POST['status'];

            	//update the values
            	$sql2 = "UPDATE tbl_book SET
            		passengers = $passengers,
            		pickup = '$pickup',
            		destination = '$destination',
            		total = $total,
            		status = '$status'
            		WHERE id=$id
            	";

            	//execute the query
            	$res2 = mysqli_query($conn, $sql2);

            	//check whether it is updated or not
            	if($res2==true)
            	{
            		//updated
            		$_SESSION['update'] = "<div class='success'> Booking Updated Succesffully.</div>";
            		header('location:'.SITEURL.'admin/manage-booking.php');
            	}
            	else
            	{
            		//failed to update
            		$_SESSION['update'] = "<div class='error'>Failed To Update..</div>";
            		header('location:'.SITEURL.'admin/manage-booking.php');
            	}

            	//redirect to manage-bookings page with message
            }

            ?>

 			
 		</div>
 		
 	</div>


 <?php include('constants/footer.php'); ?>