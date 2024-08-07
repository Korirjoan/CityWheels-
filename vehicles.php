<?php include('constants/navbar.php'); ?>

<br>


<!-- taxi sEARCH Section Starts Here -->
    <section class="taxi-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>vehicle-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Your Preffered Vehicle Type or Service.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- taxi sEARCH Section Ends Here -->

    <br>

 
  <!-- taxi MEnu Section Starts Here -->
    <section class="taxi-menu wrapper">
        <div class="container">
        	<div class="wrapper">
            <h2 class="text-center">Our Vehicles</h2>

            <?php 

              //Display vehicles that are active
              $sql = "SELECT * FROM tbl_car WHERE active='Yes'";

              //execute the query
              $res = mysqli_query($conn, $sql);

              //count rows
              $count = mysqli_num_rows($res);

              //check whether the vehicle is available or not
              if($count>0)
              {
                //vehicle available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values
                    $id = $row['id'];
                    $tittle = $row['tittle'];
                    $passengers = $row['passengers'];
                    $image_name = $row['image_name'];
                    $details = $row['details'];

                    ?>

                    <div class="taxi-menu-box">
                        <div class="taxi-menu-img">
                            <?php 

                              //check whether image is available or not
                              if($image_name=="")
                              {
                                //image not available
                                echo "<div class='error'>Image Not Available.</div>";
                              }
                              else
                              {
                                //image available
                                ?>

                                  <img src="<?php echo SITEURL; ?>images/cars/<?php echo $image_name; ?>" alt="Taxi Image" class="img-responsive img-curve"> 

                                <?php
                              }

                            ?>
                            
                        </div>

                        <div class="taxi-menu-desc">
                            <h4><?php echo $tittle; ?></h4>
                            <p class="taxi-passengers">Max. Passengers <?php echo $passengers; ?></p>
                            <p class="taxi-detail">
                                <?php echo $details; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>book.php?vehicle_id=<?php echo $id; ?>" class="btn btn-primary">Book Now</a>
                        </div>
                        </div>


                    <?php
                }

              }
              else
              {
                //vehicles not available
                echo "<div class='error'>Vehicle Not Found</div>";
              }

            ?>

               
               
               

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- taxi Menu Section Ends Here -->



<?php include('constants/footer.php'); ?>


