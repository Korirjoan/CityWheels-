<?php include('constants/navbar.php'); ?>


<!-- taxi sEARCH Section Starts Here -->
    <section class="taxi-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>vehicle-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Your Preffered Vehicle Name E.g 'Noah'.." required>
                <input type="submit" name="submit" value="search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- taxi sEARCH Section Ends Here -->
    <br><br>

    <?php 

        if(isset($_SESSION['book']))
        {
            echo $_SESSION['book'];
            unset($_SESSION['book']);
        }

    ?>



<!--services section starts here-->
<section class="services">
	<div class="container">
	<div class="wrapper">
		<h3 class="text-center">Services</h3>


        <?php 

            //create sql query to get data from database 
            $sql = "SELECT * FROM tbl_services WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //Execute the query
            $res = mysqli_query($conn,$sql);

            //count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                //service available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values like id image and tittle
                    $id = $row['id'];
                    $tittle = $row['tittle'];
                    $image_name = $row['image_name'];

                    ?>

                    <a href="<?php echo SITEURL; ?>category-vehicles.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 
                                //check whether image is available or not
                              if($image_name=="")
                              {
                                //display message
                                echo "<div class='error'>Image Not Available</div>";
                              }
                              else
                              {
                                //image available
                                ?>
                                  <img src="<?php echo SITEURL; ?>images/service/<?php echo $image_name; ?>" alt="taxi" class="img-responsive img-curve">

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
                //service not available
                echo "<div class='error'>Service Not Added</div>";
            }


        ?>


            <div class="clearfix"></div>
		</div>
	</div>
	
</section>

<!--services section ends here-->



<!--taxi section starts here-->
<section class="taxi-menu wrapper">
	<div class="container">
		<div class="wrapper">
		<h3 class="text-center">Available Vehicles</h3>


        <?php 

        //getting vehicles from database that are Active and featured
        //sql query
        $sql2 = "SELECT * FROM tbl_car WHERE active='Yes' AND featured='Yes'";

        //execute the query
        $res2 = mysqli_query($conn, $sql2);

        //count the rows
        $count = mysqli_num_rows($res2);

        //check whether vehicle is available or not
        if($count>0)
        {
            //vehicle available
            while($row=mysqli_fetch_assoc($res2))
            {
                //get all the values
                $id = $row['id'];
                $tittle = $row['tittle'];
                $passengers = $row['passengers'];
                $image_name = $row['image_name'];
                $details = $row['details'];

                ?>

                    <div class="taxi-menu-box">
                        <div class="taxi-menu-img">

                            <?php
                                //ceche whether image is available
                                if($image_name=="")
                                {
                                    //image not available
                                    echo "<div class='error'>Image Not Available.</div>";
                                }
                                else
                                {
                                    //image available
                                    ?>
                                      <img src="<?php echo SITEURL; ?>images/cars/<?php echo $image_name; ?>" alt="image" class="img-responsive img-curve">
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
            //vehicle not available
            echo "<div class='error'>Vehicle Not Available.</div>";
        }






        ?>
	
	
	


<div class="clearfix"></div>
</div>
</section>

<!--taxi section ends here-->

<?php include('constants/footer.php'); ?>