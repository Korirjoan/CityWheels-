<?php include('constants/navbar.php'); ?>

<!-- CAtegories Section Starts Here -->
    <section class="services wrapper">
        <div class="container">
            <h2 class="text-center">Explore Vehicles</h2>


               <?php 

               //display all the categories that are active
               //sql query
               $sql = "SELECT * FROM tbl_services WHERE active='Yes'"; 

               //execute the query
               $res = mysqli_query($conn, $sql);

               //count rows
               $count = mysqli_num_rows($res);

               //check whether category is available or not
               if($count>0)
               {
                 //category is available
                  while($row=mysqli_fetch_assoc($res))
                  {
                    //get the values
                    $id = $row['id'];
                    $tittle = $row['tittle'];
                    $image_name = $row['image_name'];

                    ?>

                       <a href="<?php echo SITEURL; ?>category-vehicles.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 

                                if($image_name=="")
                                {
                                    //image is not available
                                    echo "<div class='error'>Image Not Found</div>";
                                }
                                else
                                {
                                    //image available
                                    ?>
                                      <img src="<?php echo SITEURL; ?>images/service/<?php echo $image_name; ?>" alt="Taxi" class="img-responsive img-curve">
                                    <?php
                                }

                            ?>
                            

                            <h3 class="float-text text-white"><?php echo $tittle; ?></h3>
                        </div>
                       </a>

                    <?php
                  }

               }
               else
               {
                //category not available
                echo "<div class='error'>Service Currently Not Available</div>";
               }


               ?>

          

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('constants/footer.php'); ?>


    