<?php include('constants/navbar.php'); ?>
   
 <!---content section starts here-->
 <div class="content">
 	<div class="wrapper">
 		<h2>Manage Cars</h2>

        <br><br>

        <!--- Button to add admin--->
            <a href="<?php echo SITEURL; ?>admin/add-car.php" class="btn-primary">Add Car</a>

            <br> <br>

            <?php 

              if(isset($_SESSION['add']))
              {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
              }

              if(isset($_SESSION['delete']))
              {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
              }

              if(isset($_SESSION['upload']))
              {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
              }

              if(isset($_SESSION['unauthorized']))
              {
                echo $_SESSION['unauthorized'];
                unset($_SESSION['unauthorized']);
              }


              if(isset($_SESSION['update']))
              {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
              }


            ?>


            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Tittle</th>
                    <th>Max. Passengers</th>
                    <th>Details</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>


                <?php 

                    //create a sql query to get all cars
                    $sql = "SELECT * FROM tbl_car";

                    //execute the query
                    $res = mysqli_query($conn, $sql);


                    //count rows to check whether we have cars or not
                    $count = mysqli_num_rows($res);

                    //create serial number and set default value
                    $sn=1;

                    if($count>0)
                    {
                        //we have cars in database
                        //get the cars from database display
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get the value for individual colums
                            $id = $row['id'];
                            $tittle = $row['tittle'];
                            $passengers = $row['passengers'];
                            $details = $row['details'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>

                                 <tr>
                                    <td><?php echo $sn++; ?>.</td>
                                    <td><?php echo $tittle; ?></td>
                                    <td>Max. Passengers  <?php echo $passengers; ?></td>
                                    <td><?php echo $details; ?></td>
                                    <td>
                                        <?php  

                                            //check whether we have image or not
                                            if($image_name=="")
                                            {
                                                //we do not have image, display error message
                                                echo "<div class='error'>Image Not Added.</div>";
                                            }
                                            else
                                            {
                                                //we have image, Display Image
                                                ?>

                                                <img src="<?php echo SITEURL; ?>images/cars/<?php echo $image_name; ?>" width="100px">


                                                <?php
                                            }


                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-car.php?id=<?php echo $id; ?>"class="btn-secondary">Update Vehicle</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-car.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Vehicle</a>
                                        
                                    </td>
                                </tr>

                            <?php
                        }

                    }
                    else
                    {
                        //food not added in database
                        echo "<tr><td colspan='8' class='error'>Car Not Added yet</td></tr>";
                    }


                ?>



               


                 
            </table>


 		
 	</div> 	
 </div>
  <!---content section ends here-->



<?php include('constants/footer.php'); ?>


