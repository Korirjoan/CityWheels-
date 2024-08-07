<?php include('constants/navbar.php'); ?>

<!-- taxi sEARCH Section Starts Here -->
    <section class="taxi-search text-center">
        <div class="container">

            <?php 

               //get the keyword
                $search = $_POST['search'];

            ?>
            
            <h2>Vehicle on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- taxi sEARCH Section Ends Here -->
    <br>
    <br>



    <!-- taxi MEnu Section Starts Here -->
    <section class="taxi-menu wrapper">
        <div class="container">
            <h2 class="text-center">Vehicles</h2>

            <?php 

                //sql query to get vehicle based on search keyword
                $sql = "SELECT * FROM tbl_car WHERE tittle LIKE '%$search%' OR details LIKE '%$search%'";

                //execute the query
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check whether vehicle is available or not
                if($count>0)
                {
                    //vehicle available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the details
                        $id = $row['id'];
                        $tittle = $row['tittle'];
                        $passengers = $row['passengers'];
                        $details = $row['details'];
                        $image_name = $row['image_name'];

                        ?>

                        <div class="taxi-menu-box">
                            <div class="taxi-menu-img">

                                <?php 

                                  //check whether image name is available or not
                                  if($image_name=="")
                                  {
                                    //image not available
                                    echo "<div class='error'>Image Not Available.</div>";
                                  }
                                  else
                                  {
                                    //image available
                                    ?>

                                      <img src="<?php echo SITEURL; ?>images/cars/<?php echo $image_name; ?>" alt="taxi image" class="img-responsive img-curve">

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

                                <a href="book.php" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>


                        <?php

                    }
                }
                else
                {
                    //vehicle not available
                    echo "<div class='error'>Vehicle Currently Not Available.</div>";
                }



            ?>



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('constants/footer.php'); ?>