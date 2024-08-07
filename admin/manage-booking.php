<?php include('constants/navbar.php'); ?>
   
 <!---content section starts here-->
 <div class="content">
 	<div class="wrapper">
 		<h2>Manage Bookings</h2>



            <br> <br>

            <?php 

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

            ?>


            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Vehicle</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Passengers</th>
                    <th>Pick Up </th>
                    <th>Destination </th>
                    <th>Booking Date </th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>

                <?php 

                    //get all bookings from database
                    $sql = "SELECT * FROM tbl_book ORDER BY id DESC"; //DISPLAY LATEST BOOKING FAST
                    //execute query
                    $res = mysqli_query($conn, $sql);
                    //count the rows
                    $count = mysqli_num_rows($res);

                    $sn = 1;

                    if($count>0)
                    {
                        //booking available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get all the booking details
                            $id = $row['id'];
                            $car = $row['car'];
                            $customer_name = $row['customer_name'];
                            $contact = $row['contact'];
                            $email = $row['email'];
                            $passengers = $row['passengers'];
                            $pickup = $row['pickup'];
                            $destination = $row['destination'];
                            $book_date = $row['book_date'];
                            $total = $row['total'];
                            $status = $row['status'];

                            ?>


                              <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $car; ?></td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $contact; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $passengers; ?></td>
                                <td><?php echo $pickup; ?></td>
                                <td><?php echo $destination; ?></td>
                                <td><?php echo $book_date; ?></td>
                                <td><?php echo $total; ?></td>

                                <td>

                                    <?php 
                                       //booked,alighted,borded,cancelled

                                      if($status=="Booked")
                                      {
                                        echo "<label>$status</label>";
                                      }
                                      elseif($status=="Boarded")
                                      {
                                        echo "<label style='color: violet;'>$status</label>";
                                      }
                                      elseif($status=="Alighted")
                                      {
                                        echo "<label style='color:blue;'>$status</label>";
                                      }
                                      elseif($status=="Cancelled")
                                      {
                                        echo "<label style='color: red;'>$status</label>";
                                      }
                                    ?>
                                    
                                </td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-booking.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>

                                    
                                </td>
                              </tr>  


                            <?php
                        }
                    }
                    else
                    {
                        //bookings not available
                        echo "<tr><td colspan='11' class='error'>Bookings Not Available.</td></tr>";
                    }

                ?>

            </table>



 		
 	</div> 	
 </div>
  <!---content section ends here-->



<?php include('constants/footer.php'); ?>