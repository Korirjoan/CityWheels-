<?php include('constants/navbar.php'); ?>


<!---content section starts here-->
 <div class="content">
 	<div class="wrapper">
 		<h2>Manage Services</h2>
        <br><br>


         <?php 

         if(isset($_SESSION['add']))
         {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
         }


          if(isset($_SESSION['remove']))
         {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
         }


         if(isset($_SESSION['delete']))
         {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
         }


         if(isset($_SESSION['no-service-found']))
         {
            echo $_SESSION['no-service-found'];
            unset($_SESSION['no-service-found']);
         }

         if(isset($_SESSION['update']))
         {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
         }
         

         if(isset($_SESSION['upload']))
         {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
         }

         if(isset($_SESSION['failed-remove']))
         {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
         }

        ?>

        <br><br>


        <!--- Button to add admin--->
            <a href="<?php echo SITEURL; ?>admin/add-service.php" class="btn-primary">Add Service</a>

            <br> <br>


            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Tittle</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //query to get all services from the database
                   $sql = "SELECT * FROM tbl_services";

                   //execute query
                   $res = mysqli_query($conn, $sql);

                   //count rows
                   $count = mysqli_num_rows($res);

                   //create serial number variable and assigne value as 1
                   $sn=1;

                   //check whether data is available in database
                   if($count>0)
                   {
                    //we have data in database
                    //get the data and display
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $tittle = $row['tittle'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>

                             <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $tittle; ?></td>

                                <td>

                                    <?php

                                      //check whether image name is available or not
                                      if($image_name!="")
                                      {
                                        //display the image
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/service/<?php echo $image_name; ?>" width="100px">
                                        <?php
                                      }
                                      else
                                      {
                                        //display the message
                                        echo "<div class='error'>Image Not Added</div>";
                                      }


                                    ?>
                                        
                                </td>

                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL ?>admin/update-service.php?id=<?php echo $id; ?>" class="btn-secondary">Update Service</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-service.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Service</a>
                                    
                                </td>
                            </tr>

                        <?php



                    }
                   }
                   else
                   {
                    //we dont have data in database
                    //we will display the message inside table
                    ?>
                    
                    <tr>
                        <td colspan="6"><div class="error">No Category Added</div></td>
                    </tr>


                    <?php



                   }


                ?>   


            </table>

 		
 	</div>
 </div>
 <!---content section ends here-->



<?php include('constants/footer.php'); ?>